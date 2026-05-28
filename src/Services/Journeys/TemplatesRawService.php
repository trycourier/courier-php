<?php

declare(strict_types=1);

namespace Courier\Services\Journeys;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyTemplateGetResponse;
use Courier\Journeys\JourneyTemplateListResponse;
use Courier\Journeys\Templates\TemplateArchiveParams;
use Courier\Journeys\Templates\TemplateCreateParams;
use Courier\Journeys\Templates\TemplateCreateParams\Notification;
use Courier\Journeys\Templates\TemplateListParams;
use Courier\Journeys\Templates\TemplateListVersionsParams;
use Courier\Journeys\Templates\TemplatePublishParams;
use Courier\Journeys\Templates\TemplateReplaceParams;
use Courier\Journeys\Templates\TemplateRetrieveParams;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Journeys\TemplatesRawContract;

/**
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateCreateParams\Notification
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateReplaceParams\Notification as NotificationShape1
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TemplatesRawService implements TemplatesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a notification template scoped to this journey. Defaults to `DRAFT` state; pass `state: "PUBLISHED"` to publish on create.
     *
     * @param string $templateID Journey id
     * @param array{
     *   channel: string,
     *   notification: Notification|NotificationShape,
     *   providerKey?: string,
     *   state?: string,
     * }|TemplateCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyTemplateGetResponse>
     *
     * @throws APIException
     */
    public function create(
        string $templateID,
        array|TemplateCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['journeys/%1$s/templates', $templateID],
            body: (object) $parsed,
            options: $options,
            convert: JourneyTemplateGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Fetch a journey-scoped notification template by id. Pass `?version=draft` (default `published`) to retrieve the working draft, or `?version=vN` for a historical version.
     *
     * @param string $notificationID Notification template id
     * @param array{templateID: string}|TemplateRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyTemplateGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $notificationID,
        array|TemplateRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['journeys/%1$s/templates/%2$s', $templateID, $notificationID],
            options: $options,
            convert: JourneyTemplateGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List notification templates scoped to this journey. Journey-scoped notification templates can only be referenced from `send` nodes within the same journey.
     *
     * @param string $templateID Journey id
     * @param array{cursor?: string, limit?: int}|TemplateListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyTemplateListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $templateID,
        array|TemplateListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['journeys/%1$s/templates', $templateID],
            query: $parsed,
            options: $options,
            convert: JourneyTemplateListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archive the journey-scoped notification template. Archived templates cannot be sent.
     *
     * @param string $notificationID Notification template id
     * @param array{templateID: string}|TemplateArchiveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $notificationID,
        array|TemplateArchiveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateArchiveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['journeys/%1$s/templates/%2$s', $templateID, $notificationID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List published versions of the journey-scoped notification template, ordered most recent first.
     *
     * @param string $notificationID Notification template id
     * @param array{templateID: string}|TemplateListVersionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateVersionListResponse>
     *
     * @throws APIException
     */
    public function listVersions(
        string $notificationID,
        array|TemplateListVersionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateListVersionsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'journeys/%1$s/templates/%2$s/versions', $templateID, $notificationID,
            ],
            options: $options,
            convert: NotificationTemplateVersionListResponse::class,
        );
    }

    /**
     * @api
     *
     * Publish the current draft of the journey-scoped notification template as a new version. Optionally roll back to a prior version by passing `{ "version": "vN" }`.
     *
     * @param string $notificationID Path param: Notification template id
     * @param array{templateID: string, version?: string}|TemplatePublishParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function publish(
        string $notificationID,
        array|TemplatePublishParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplatePublishParams::parseRequest(
            $params,
            $requestOptions,
        );
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'journeys/%1$s/templates/%2$s/publish', $templateID, $notificationID,
            ],
            body: (object) array_diff_key($parsed, array_flip(['templateID'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Replace the journey-scoped notification template draft.
     *
     * @param string $notificationID Path param: Notification template id
     * @param array{
     *   templateID: string,
     *   notification: TemplateReplaceParams\Notification|NotificationShape1,
     *   state?: string,
     * }|TemplateReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyTemplateGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $notificationID,
        array|TemplateReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['journeys/%1$s/templates/%2$s', $templateID, $notificationID],
            body: (object) array_diff_key($parsed, array_flip(['templateID'])),
            options: $options,
            convert: JourneyTemplateGetResponse::class,
        );
    }
}
