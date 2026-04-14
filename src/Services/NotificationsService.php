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
use Courier\Notifications\NotificationListResponse;
use Courier\Notifications\NotificationPutContentParams\Content;
use Courier\Notifications\NotificationPutLocaleParams\Element;
use Courier\Notifications\NotificationTemplatePayload;
use Courier\Notifications\NotificationTemplateResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\NotificationsContract;
use Courier\Services\Notifications\ChecksService;

/**
 * @phpstan-import-type ContentShape from \Courier\Notifications\NotificationPutContentParams\Content
 * @phpstan-import-type ElementShape from \Courier\Notifications\NotificationPutLocaleParams\Element
 * @phpstan-import-type NotificationTemplatePayloadShape from \Courier\Notifications\NotificationTemplatePayload
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
     * @param NotificationTemplatePayload|NotificationTemplatePayloadShape $notification core template fields used in POST and PUT request bodies (nested under a `notification` key) and returned at the top level in responses
     * @param State|value-of<State> $state Template state after creation. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        NotificationTemplatePayload|array $notification,
        State|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationTemplateResponse {
        $params = Util::removeNulls(
            ['notification' => $notification, 'state' => $state]
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
     * List notification templates in your workspace.
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
     * Archive a notification template.
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
     * List versions of a notification template.
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
     * @param string $id template ID (nt_ prefix)
     * @param string $version Historical version to publish (e.g. "v001"). Omit to publish the current draft.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        string $id,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['version' => $version]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->publish($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace the elemental content of a notification template. Overwrites all elements in the template with the provided content. Only supported for V2 (elemental) templates.
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
     * Update a single element within a notification template. Only supported for V2 (elemental) templates.
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
     * Set locale-specific content overrides for a notification template. Each element override must reference an existing element by ID. Only supported for V2 (elemental) templates.
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
     * Replace a notification template. All fields are required.
     *
     * @param string $id template ID (nt_ prefix)
     * @param NotificationTemplatePayload|NotificationTemplatePayloadShape $notification core template fields used in POST and PUT request bodies (nested under a `notification` key) and returned at the top level in responses
     * @param \Courier\Notifications\NotificationReplaceParams\State|value-of<\Courier\Notifications\NotificationReplaceParams\State> $state Template state after update. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $id,
        NotificationTemplatePayload|array $notification,
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
     * Retrieve the content of a notification template. The response shape depends on whether the template uses V1 (blocks/channels) or V2 (elemental) content. Use the `version` query parameter to select draft, published, or a specific historical version.
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
