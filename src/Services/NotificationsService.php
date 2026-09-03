<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationCreateParams\State;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationGetMetricsParams\Granularity;
use Courier\Notifications\NotificationListResponse;
use Courier\Notifications\NotificationMetricsResponse;
use Courier\Notifications\NotificationPutContentParams\Content;
use Courier\Notifications\NotificationPutLocaleParams\Element;
use Courier\Notifications\NotificationTemplateResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\Notifications\NotificationTemplateWritePayload;
use Courier\RequestOptions;
use Courier\ServiceContracts\NotificationsContract;
use Courier\Services\Notifications\ChecksService;

/**
 * Create, update, version, publish, and localize notification templates and their content.
 *
 * @phpstan-import-type ContentShape from \Courier\Notifications\NotificationPutContentParams\Content
 * @phpstan-import-type ElementShape from \Courier\Notifications\NotificationPutLocaleParams\Element
 * @phpstan-import-type NotificationTemplateWritePayloadShape from \Courier\Notifications\NotificationTemplateWritePayload
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class NotificationsService implements NotificationsContract
{
    /**
     * @api
     */
    public NotificationsRawService $raw;

    /**
     * @api
     */
    public ChecksService $checks;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new NotificationsRawService($client);
        $this->checks = new ChecksService($client);
    }

    /**
     * @api
     *
     * Create a notification template. Requires all fields in the notification object. Templates are created in draft state by default.
     *
     * Content must place its elements inside a channel block — `{ "type": "channel", "channel": "email", "elements": [...] }` — or the request returns `400`. The template designer renders only the channel block matching the tab it draws, so content stored without one cannot be opened. An empty `elements` array is accepted, and the requirement applies to creation only: `PUT /notifications/{id}` still accepts unwrapped content. Note this endpoint takes versioned content only — the `{ title, body }` shorthand accepted by `/send` is rejected here with an `invalid_request_error` on `notification.content.version`.
     *
     * @param NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape $notification body param: Template fields accepted in POST and PUT request bodies, nested under a `notification` key
     * @param State|value-of<State> $state Body param: Template state after creation. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        NotificationTemplateWritePayload|array $notification,
        State|string $state = 'DRAFT',
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationTemplateResponse {
        $params = Util::removeNulls(
            [
                'notification' => $notification,
                'state' => $state,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a notification template by ID. Returns the published version by default. Pass version=draft to retrieve an unpublished template.
     *
     * @param string $id template ID (nt_ prefix)
     * @param string $version Version to retrieve. One of "draft", "published", or a version string like "v001". Defaults to "published".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationTemplateResponse {
        $params = Util::removeNulls(['version' => $version]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists the workspace's notification templates. Each carries a name, tags, brand, routing, and its draft or published state.
     *
     * @param string|null $cursor Opaque pagination cursor from a previous response. Omit for the first page.
     * @param string $eventID filter to templates linked to this event map ID
     * @param bool|null $notes Include template notes in the response. Only applies to legacy templates.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $eventID = null,
        ?bool $notes = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationListResponse {
        $params = Util::removeNulls(
            ['cursor' => $cursor, 'eventID' => $eventID, 'notes' => $notes]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archives a notification template, preventing new sends from referencing it. The template stays retrievable for its version history.
     *
     * @param string $id template ID (nt_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch the delivery funnel for one Notification Template as a time series — sent, delivered, opened, clicked, errors, and undeliverable — broken out per provider and channel inside each bucket. Sum the entries in a bucket for its totals; there is no bucket-level total.
     *
     * Choose the window absolutely with `start` and `end`, or relatively with `lookback` (an ISO 8601 duration). `start` and `end` take precedence when both are supplied, and a request carrying neither defaults to `lookback=P30D`. The window is snapped outwards onto the `granularity` grid so every bucket it overlaps is returned whole, and the snapped boundaries come back as `start` and `end` — align a chart on those rather than on what was requested. Every boundary is UTC; there is no timezone support.
     *
     * Every bucket in the window is returned, including the quiet ones, whose `data` array is empty, so a series is directly plottable with no gap filling client-side. An unknown template id returns `200` with an all-empty series rather than `404`, and messages sent without a Notification Template never appear here.
     *
     * Available in the US region only.
     *
     * @param string $id The Notification Template to report on — its ID (`nt_` prefix) or an alias. Must not contain commas or whitespace.
     * @param \DateTimeInterface $end The end of the window, as an ISO 8601 timestamp with an offset. Must be supplied together with `start`. An `end` in the future is accepted and not clamped — the trailing buckets come back empty.
     * @param Granularity|value-of<Granularity> $granularity The size of each bucket in the series. Defaults to `DAY`. `WEEK` buckets start on Sunday. A fine granularity caps the window it can cover: `HOUR` spans at most 7 days and `DAY` at most 90 days, and a wider window returns `400` — request a coarser granularity instead. `WEEK` and `MONTH` are uncapped, subject to the 1000-bucket limit on a single response.
     * @param string $lookback The length of the window, counted back from now, as an ISO 8601 duration (`P30D`, `P12W`, `PT12H`). Defaults to `P30D`, and is ignored when `start` and `end` are supplied. A malformed or non-positive duration returns `400`.
     * @param \DateTimeInterface $start The inclusive start of the window, as an ISO 8601 timestamp with an offset (`2026-04-01T00:00:00Z`). Must be supplied together with `end` and be earlier than it; either one alone returns `400`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getMetrics(
        string $id,
        ?\DateTimeInterface $end = null,
        Granularity|string $granularity = 'DAY',
        string $lookback = 'P30D',
        ?\DateTimeInterface $start = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationMetricsResponse {
        $params = Util::removeNulls(
            [
                'end' => $end,
                'granularity' => $granularity,
                'lookback' => $lookback,
                'start' => $start,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getMetrics($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a notification template's published versions, most recent first, for comparison or rollback. Paged.
     *
     * @param string $id template ID (nt_ prefix)
     * @param string $cursor Opaque pagination cursor from a previous response. Omit for the first page.
     * @param int $limit Maximum number of versions to return per page. Default 10, max 10.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listVersions(
        string $id,
        ?string $cursor = null,
        int $limit = 10,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationTemplateVersionListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listVersions($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Publish a notification template. Publishes the current draft by default. Pass a version in the request body to publish a specific historical version.
     *
     * @param string $id path param: Template ID (nt_ prefix)
     * @param string $version Body param: Historical version to publish (e.g. "v001"). Omit to publish the current draft.
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        string $id,
        ?string $version = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'version' => $version,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->publish($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replaces all Elemental content in a template, overwriting every existing element. Supported for V2 templates only, not V1 blocks and channels.
     *
     * @param string $id notification template ID (`nt_` prefix)
     * @param Content|ContentShape $content Elemental content payload. The server defaults `version` when omitted.
     * @param NotificationTemplateState|value-of<NotificationTemplateState> $state Template state. Defaults to `DRAFT`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function putContent(
        string $id,
        Content|array $content,
        NotificationTemplateState|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentMutationResponse {
        $params = Util::removeNulls(['content' => $content, 'state' => $state]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->putContent($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replaces one Elemental element in a template, addressed by its element id. Supported for V2 templates only, not V1 blocks and channels.
     *
     * @param string $elementID path param: Element ID within the template
     * @param string $id path param: Notification template ID (`nt_` prefix)
     * @param string $type Body param: Element type (text, meta, action, image, etc.).
     * @param list<string> $channels Body param
     * @param array<string,mixed> $data Body param
     * @param string $if Body param
     * @param string $loop Body param
     * @param string $ref Body param
     * @param NotificationTemplateState|value-of<NotificationTemplateState> $state Body param: Template state. Defaults to `DRAFT`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function putElement(
        string $elementID,
        string $id,
        string $type,
        ?array $channels = null,
        ?array $data = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        NotificationTemplateState|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentMutationResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'type' => $type,
                'channels' => $channels,
                'data' => $data,
                'if' => $if,
                'loop' => $loop,
                'ref' => $ref,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->putElement($elementID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sets locale-specific content overrides for a template. Each override must reference an element that already exists in the default content.
     *
     * @param string $localeID Path param: Locale code (e.g., `es`, `fr`, `pt-BR`).
     * @param string $id path param: Notification template ID (`nt_` prefix)
     * @param list<Element|ElementShape> $elements body param: Elements with locale-specific content overrides
     * @param NotificationTemplateState|value-of<NotificationTemplateState> $state Body param: Template state. Defaults to `DRAFT`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function putLocale(
        string $localeID,
        string $id,
        array $elements,
        NotificationTemplateState|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentMutationResponse {
        $params = Util::removeNulls(
            ['id' => $id, 'elements' => $elements, 'state' => $state]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->putLocale($localeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replaces a notification template in full, so send every field rather than only the ones you want changed. Publish separately to make it live.
     *
     * @param string $id template ID (nt_ prefix)
     * @param NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape $notification template fields accepted in POST and PUT request bodies, nested under a `notification` key
     * @param \Courier\Notifications\NotificationReplaceParams\State|value-of<\Courier\Notifications\NotificationReplaceParams\State> $state Template state after update. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $id,
        NotificationTemplateWritePayload|array $notification,
        \Courier\Notifications\NotificationReplaceParams\State|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationTemplateResponse {
        $params = Util::removeNulls(
            ['notification' => $notification, 'state' => $state]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a template's content and checksum. V2 templates return Elemental elements, while V1 templates return blocks and channels instead.
     *
     * @param string $id notification template ID (`nt_` prefix)
     * @param string $version Accepts `draft`, `published`, or a version string (e.g., `v001`). Defaults to `published`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentGetResponse|NotificationGetContent {
        $params = Util::removeNulls(['version' => $version]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveContent($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
