<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Journeys;

use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyTemplateGetResponse;
use Courier\Journeys\JourneyTemplateListResponse;
use Courier\Journeys\Templates\TemplateCreateParams\Notification;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateCreateParams\Notification
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateReplaceParams\Notification as NotificationShape1
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TemplatesContract
{
    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param Notification|NotificationShape $notification
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $templateID,
        string $channel,
        Notification|array $notification,
        ?string $providerKey = null,
        ?string $state = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyTemplateGetResponse;

    /**
     * @api
     *
     * @param string $notificationID Notification template id
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $notificationID,
        string $templateID,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyTemplateGetResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param string $cursor pagination cursor from a prior response
     * @param int $limit Page size. Minimum 1, maximum 100.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $templateID,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyTemplateListResponse;

    /**
     * @api
     *
     * @param string $notificationID Notification template id
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $notificationID,
        string $templateID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $notificationID Notification template id
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listVersions(
        string $notificationID,
        string $templateID,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationTemplateVersionListResponse;

    /**
     * @api
     *
     * @param string $notificationID Path param: Notification template id
     * @param string $templateID Path param: Journey id
     * @param string $version Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        string $notificationID,
        string $templateID,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $notificationID Path param: Notification template id
     * @param string $templateID Path param: Journey id
     * @param \Courier\Journeys\Templates\TemplateReplaceParams\Notification|NotificationShape1 $notification Body param
     * @param string $state Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $notificationID,
        string $templateID,
        \Courier\Journeys\Templates\TemplateReplaceParams\Notification|array $notification,
        ?string $state = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyTemplateGetResponse;
}
