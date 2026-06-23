<?php

declare(strict_types=1);

namespace Courier\Services\Journeys;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
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
use Courier\ServiceContracts\Journeys\TemplatesContract;

/**
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateCreateParams\Notification
 * @phpstan-import-type ContentShape from \Courier\Journeys\Templates\TemplatePutContentParams\Content
 * @phpstan-import-type ElementShape from \Courier\Journeys\Templates\TemplatePutLocaleParams\Element
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateReplaceParams\Notification as NotificationShape1
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TemplatesService implements TemplatesContract
{
    /**
     * @api
     */
    public TemplatesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TemplatesRawService($client);
    }

    /**
     * @api
     *
     * Create a notification template scoped to this journey. Defaults to `DRAFT` state; pass `state: "PUBLISHED"` to publish on create.
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
    ): JourneyTemplateGetResponse {
        $params = Util::removeNulls(
            [
                'channel' => $channel,
                'notification' => $notification,
                'providerKey' => $providerKey,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch a journey-scoped notification template by id. Pass `?version=draft` (default `published`) to retrieve the working draft, or `?version=vN` for a historical version.
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
    ): JourneyTemplateGetResponse {
        $params = Util::removeNulls(['templateID' => $templateID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($notificationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List notification templates scoped to this journey. Journey-scoped notification templates can only be referenced from `send` nodes within the same journey.
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
    ): JourneyTemplateListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive the journey-scoped notification template. Archived templates cannot be sent.
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
    ): mixed {
        $params = Util::removeNulls(['templateID' => $templateID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($notificationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List published versions of the journey-scoped notification template, ordered most recent first.
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
    ): NotificationTemplateVersionListResponse {
        $params = Util::removeNulls(['templateID' => $templateID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listVersions($notificationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Publish the current draft of the journey-scoped notification template as a new version. Optionally roll back to a prior version by passing `{ "version": "vN" }`.
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
    ): mixed {
        $params = Util::removeNulls(
            ['templateID' => $templateID, 'version' => $version]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->publish($notificationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace the elemental content of a journey-scoped notification template. Overwrites all elements in the template draft with the provided content.
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
    ): NotificationContentMutationResponse {
        $params = Util::removeNulls(
            ['templateID' => $templateID, 'content' => $content, 'state' => $state]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->putContent($notificationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Set locale-specific content overrides for a journey-scoped notification template. Each element override must reference an existing element by ID.
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
    ): NotificationContentMutationResponse {
        $params = Util::removeNulls(
            [
                'templateID' => $templateID,
                'notificationID' => $notificationID,
                'elements' => $elements,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->putLocale($localeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace the journey-scoped notification template draft.
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
    ): JourneyTemplateGetResponse {
        $params = Util::removeNulls(
            [
                'templateID' => $templateID,
                'notification' => $notification,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($notificationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the elemental content of a journey-scoped notification template. The response contains the versioned elements along with their content checksums, which can be used to detect changes between versions. Pass `?version=draft` (default `published`) to retrieve the working draft, or `?version=vN` for a historical version.
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
    ): NotificationContentGetResponse {
        $params = Util::removeNulls(
            ['templateID' => $templateID, 'version' => $version]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveContent($notificationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
