<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationCreateParams\State;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListResponse;
use Courier\Notifications\NotificationTemplateGetResponse;
use Courier\Notifications\NotificationTemplateMutationResponse;
use Courier\Notifications\NotificationTemplatePayload;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;

/**
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): NotificationGetContent;
}
