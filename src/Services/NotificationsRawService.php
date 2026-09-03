<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationCreateParams;
use Courier\Notifications\NotificationCreateParams\State;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationGetContentResponse;
use Courier\Notifications\NotificationGetMetricsParams;
use Courier\Notifications\NotificationGetMetricsParams\Granularity;
use Courier\Notifications\NotificationListParams;
use Courier\Notifications\NotificationListResponse;
use Courier\Notifications\NotificationListVersionsParams;
use Courier\Notifications\NotificationMetricsResponse;
use Courier\Notifications\NotificationPublishParams;
use Courier\Notifications\NotificationPutContentParams;
use Courier\Notifications\NotificationPutContentParams\Content;
use Courier\Notifications\NotificationPutElementParams;
use Courier\Notifications\NotificationPutLocaleParams;
use Courier\Notifications\NotificationPutLocaleParams\Element;
use Courier\Notifications\NotificationReplaceParams;
use Courier\Notifications\NotificationRetrieveContentParams;
use Courier\Notifications\NotificationRetrieveParams;
use Courier\Notifications\NotificationTemplateResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\Notifications\NotificationTemplateWritePayload;
use Courier\RequestOptions;
use Courier\ServiceContracts\NotificationsRawContract;

/**
 * Create, update, version, publish, and localize notification templates and their content.
 *
 * @phpstan-import-type ContentShape from \Courier\Notifications\NotificationPutContentParams\Content
 * @phpstan-import-type ElementShape from \Courier\Notifications\NotificationPutLocaleParams\Element
 * @phpstan-import-type NotificationTemplateWritePayloadShape from \Courier\Notifications\NotificationTemplateWritePayload
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class NotificationsRawService implements NotificationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a notification template. Requires all fields in the notification object. Templates are created in draft state by default.
     *
     * Content must place its elements inside a channel block — `{ "type": "channel", "channel": "email", "elements": [...] }` — or the request returns `400`. The template designer renders only the channel block matching the tab it draws, so content stored without one cannot be opened. An empty `elements` array is accepted, and the requirement applies to creation only: `PUT /notifications/{id}` still accepts unwrapped content. Note this endpoint takes versioned content only — the `{ title, body }` shorthand accepted by `/send` is rejected here with an `invalid_request_error` on `notification.content.version`.
     *
     * @param array{
     *   notification: NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape,
     *   state?: State|value-of<State>,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|NotificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateResponse>
     *
     * @throws APIException
     */
    public function create(
        array|NotificationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'notifications',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: NotificationTemplateResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a notification template by ID. Returns the published version by default. Pass version=draft to retrieve an unpublished template.
     *
     * @param string $id template ID (nt_ prefix)
     * @param array{version?: string}|NotificationRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        array|NotificationRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s', $id],
            query: $parsed,
            options: $options,
            convert: NotificationTemplateResponse::class,
        );
    }

    /**
     * @api
     *
     * Lists the workspace's notification templates. Each carries a name, tags, brand, routing, and its draft or published state.
     *
     * @param array{
     *   cursor?: string|null, eventID?: string, notes?: bool|null
     * }|NotificationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'notifications',
            query: Util::array_transform_keys($parsed, ['eventID' => 'event_id']),
            options: $options,
            convert: NotificationListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archives a notification template, preventing new sends from referencing it. The template stays retrievable for its version history.
     *
     * @param string $id template ID (nt_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['notifications/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
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
     * @param array{
     *   end?: \DateTimeInterface,
     *   granularity?: Granularity|value-of<Granularity>,
     *   lookback?: string,
     *   start?: \DateTimeInterface,
     * }|NotificationGetMetricsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationMetricsResponse>
     *
     * @throws APIException
     */
    public function getMetrics(
        string $id,
        array|NotificationGetMetricsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationGetMetricsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/metrics', $id],
            query: $parsed,
            options: $options,
            convert: NotificationMetricsResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns a notification template's published versions, most recent first, for comparison or rollback. Paged.
     *
     * @param string $id template ID (nt_ prefix)
     * @param array{
     *   cursor?: string, limit?: int
     * }|NotificationListVersionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateVersionListResponse>
     *
     * @throws APIException
     */
    public function listVersions(
        string $id,
        array|NotificationListVersionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationListVersionsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/versions', $id],
            query: $parsed,
            options: $options,
            convert: NotificationTemplateVersionListResponse::class,
        );
    }

    /**
     * @api
     *
     * Publish a notification template. Publishes the current draft by default. Pass a version in the request body to publish a specific historical version.
     *
     * @param string $id path param: Template ID (nt_ prefix)
     * @param array{
     *   version?: string, idempotencyKey?: string, xIdempotencyExpiration?: string
     * }|NotificationPublishParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function publish(
        string $id,
        array|NotificationPublishParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationPublishParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['notifications/%1$s/publish', $id],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Replaces all Elemental content in a template, overwriting every existing element. Supported for V2 templates only, not V1 blocks and channels.
     *
     * @param string $id notification template ID (`nt_` prefix)
     * @param array{
     *   content: Content|ContentShape,
     *   state?: NotificationTemplateState|value-of<NotificationTemplateState>,
     * }|NotificationPutContentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentMutationResponse>
     *
     * @throws APIException
     */
    public function putContent(
        string $id,
        array|NotificationPutContentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationPutContentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['notifications/%1$s/content', $id],
            body: (object) $parsed,
            options: $options,
            convert: NotificationContentMutationResponse::class,
        );
    }

    /**
     * @api
     *
     * Replaces one Elemental element in a template, addressed by its element id. Supported for V2 templates only, not V1 blocks and channels.
     *
     * @param string $elementID path param: Element ID within the template
     * @param array{
     *   id: string,
     *   type: string,
     *   channels?: list<string>,
     *   data?: array<string,mixed>,
     *   if?: string,
     *   loop?: string,
     *   ref?: string,
     *   state?: NotificationTemplateState|value-of<NotificationTemplateState>,
     * }|NotificationPutElementParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentMutationResponse>
     *
     * @throws APIException
     */
    public function putElement(
        string $elementID,
        array|NotificationPutElementParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationPutElementParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['notifications/%1$s/elements/%2$s', $id, $elementID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: NotificationContentMutationResponse::class,
        );
    }

    /**
     * @api
     *
     * Sets locale-specific content overrides for a template. Each override must reference an element that already exists in the default content.
     *
     * @param string $localeID Path param: Locale code (e.g., `es`, `fr`, `pt-BR`).
     * @param array{
     *   id: string,
     *   elements: list<Element|ElementShape>,
     *   state?: NotificationTemplateState|value-of<NotificationTemplateState>,
     * }|NotificationPutLocaleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentMutationResponse>
     *
     * @throws APIException
     */
    public function putLocale(
        string $localeID,
        array|NotificationPutLocaleParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationPutLocaleParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['notifications/%1$s/locales/%2$s', $id, $localeID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: NotificationContentMutationResponse::class,
        );
    }

    /**
     * @api
     *
     * Replaces a notification template in full, so send every field rather than only the ones you want changed. Publish separately to make it live.
     *
     * @param string $id template ID (nt_ prefix)
     * @param array{
     *   notification: NotificationTemplateWritePayload|NotificationTemplateWritePayloadShape,
     *   state?: NotificationReplaceParams\State|value-of<NotificationReplaceParams\State>,
     * }|NotificationReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $id,
        array|NotificationReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['notifications/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: NotificationTemplateResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns a template's content and checksum. V2 templates return Elemental elements, while V1 templates return blocks and channels instead.
     *
     * @param string $id notification template ID (`nt_` prefix)
     * @param array{version?: string}|NotificationRetrieveContentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentGetResponse|NotificationGetContent>
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        array|NotificationRetrieveContentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationRetrieveContentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/content', $id],
            query: $parsed,
            options: $options,
            convert: NotificationGetContentResponse::class,
        );
    }
}
