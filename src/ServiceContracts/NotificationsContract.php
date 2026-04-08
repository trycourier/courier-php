<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationCreateParams\State;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListResponse;
use Courier\Notifications\NotificationPutContentParams\Content;
use Courier\Notifications\NotificationPutLocaleParams\Element;
use Courier\Notifications\NotificationTemplateGetResponse;
use Courier\Notifications\NotificationTemplateMutationResponse;
use Courier\Notifications\NotificationTemplatePayload;
use Courier\Notifications\NotificationTemplateState;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type ContentShape from \Courier\Notifications\NotificationPutContentParams\Content
 * @phpstan-import-type ElementShape from \Courier\Notifications\NotificationPutLocaleParams\Element
 * @phpstan-import-type NotificationTemplatePayloadShape from \Courier\Notifications\NotificationTemplatePayload
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface NotificationsContract
{
    /**
     * @api
     *
     * @param NotificationTemplatePayload|NotificationTemplatePayloadShape $notification full document shape used in POST and PUT request bodies, and returned inside the GET response envelope
     * @param State|value-of<State> $state Template state after creation. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        NotificationTemplatePayload|array $notification,
        State|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationTemplateMutationResponse;

    /**
     * @api
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
    ): NotificationTemplateGetResponse;

    /**
     * @api
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
    ): NotificationListResponse;

    /**
     * @api
     *
     * @param string $id template ID (nt_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): NotificationTemplateVersionListResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): NotificationContentMutationResponse;

    /**
     * @api
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
    ): NotificationContentMutationResponse;

    /**
     * @api
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
    ): NotificationContentMutationResponse;

    /**
     * @api
     *
     * @param string $id template ID (nt_ prefix)
     * @param NotificationTemplatePayload|NotificationTemplatePayloadShape $notification full document shape used in POST and PUT request bodies, and returned inside the GET response envelope
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
    ): NotificationTemplateMutationResponse;

    /**
     * @api
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
    ): NotificationContentGetResponse|NotificationGetContent;
}
