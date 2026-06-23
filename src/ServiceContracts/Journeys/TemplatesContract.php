<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Journeys;

use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyTemplateGetResponse;
use Courier\Journeys\JourneyTemplateListResponse;
use Courier\Journeys\Templates\TemplateCreateParams\Notification;
use Courier\Journeys\Templates\TemplatePutContentParams\Content;
use Courier\Journeys\Templates\TemplatePutLocaleParams\Element;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateCreateParams\Notification
 * @phpstan-import-type ContentShape from \Courier\Journeys\Templates\TemplatePutContentParams\Content
 * @phpstan-import-type ElementShape from \Courier\Journeys\Templates\TemplatePutLocaleParams\Element
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
     * @param Content|ContentShape $content Body param: Elemental content payload. The server defaults `version` when omitted.
     * @param NotificationTemplateState|value-of<NotificationTemplateState> $state Body param: Template state. Defaults to `DRAFT`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function putContent(
        string $notificationID,
        string $templateID,
        Content|array $content,
        NotificationTemplateState|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentMutationResponse;

    /**
     * @api
     *
     * @param string $localeID Path param: Locale code (e.g., `es`, `fr`, `pt-BR`).
     * @param string $templateID Path param: Journey id
     * @param string $notificationID Path param: Notification template id
     * @param list<Element|ElementShape> $elements body param: Elements with locale-specific content overrides
     * @param NotificationTemplateState|value-of<NotificationTemplateState> $state Body param: Template state. Defaults to `DRAFT`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function putLocale(
        string $localeID,
        string $templateID,
        string $notificationID,
        array $elements,
        NotificationTemplateState|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentMutationResponse;

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

    /**
     * @api
     *
     * @param string $notificationID Path param: Notification template id
     * @param string $templateID Path param: Journey id
     * @param string $version Query param: Accepts `draft`, `published`, or a version string (e.g., `v001`). Defaults to `published`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $notificationID,
        string $templateID,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentGetResponse;
}
