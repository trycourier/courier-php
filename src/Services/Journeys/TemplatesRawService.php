<?php

declare(strict_types=1);

namespace Courier\Services\Journeys;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Journeys\JourneyTemplateGetResponse;
use Courier\Journeys\JourneyTemplateListResponse;
use Courier\Journeys\Templates\TemplateArchiveParams;
use Courier\Journeys\Templates\TemplateCreateParams;
use Courier\Journeys\Templates\TemplateCreateParams\Notification;
use Courier\Journeys\Templates\TemplateListParams;
use Courier\Journeys\Templates\TemplateListVersionsParams;
use Courier\Journeys\Templates\TemplatePublishParams;
use Courier\Journeys\Templates\TemplatePutContentParams;
use Courier\Journeys\Templates\TemplatePutContentParams\Content;
use Courier\Journeys\Templates\TemplatePutLocaleParams;
use Courier\Journeys\Templates\TemplatePutLocaleParams\Element;
use Courier\Journeys\Templates\TemplateReplaceParams;
use Courier\Journeys\Templates\TemplateRetrieveContentParams;
use Courier\Journeys\Templates\TemplateRetrieveParams;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Journeys\TemplatesRawContract;

/**
 * Build, version, publish, invoke, and cancel multi-step notification workflows, along with the templates scoped to them.
 *
 * @phpstan-import-type NotificationShape from \Courier\Journeys\Templates\TemplateCreateParams\Notification
 * @phpstan-import-type ContentShape from \Courier\Journeys\Templates\TemplatePutContentParams\Content
 * @phpstan-import-type ElementShape from \Courier\Journeys\Templates\TemplatePutLocaleParams\Element
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
     * The content tree must contain exactly one channel block whose `channel` matches the `channel` on the request — a journey-scoped template carries a single channel. Top-level elements, or a block for a different channel, return `400`. The template designer renders only the channel block matching the tab it draws, so content stored without one cannot be opened. An empty `elements` array is accepted.
     *
     * @param string $templateID Path param: Journey id
     * @param array{
     *   channel: string,
     *   notification: Notification|NotificationShape,
     *   providerKey?: string,
     *   state?: string,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
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
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['journeys/%1$s/templates', $templateID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: JourneyTemplateGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns a journey's own notification template with its name, brand, subscription topic, and content. Defaults to the published version.
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
     * Archives one journey's notification template, preventing further sends. Detach any send node referencing it beforehand.
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
     * Lists the published versions of a template that belongs to a journey, most recent first. Paged by cursor.
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
     * Publishes a journey-scoped template's draft as a new version. Pass a version instead to roll back the template to an earlier publish.
     *
     * @param string $notificationID Path param: Notification template id
     * @param array{
     *   templateID: string,
     *   version?: string,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|TemplatePublishParams $params
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
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'journeys/%1$s/templates/%2$s/publish', $templateID, $notificationID,
            ],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                array_diff_key($parsed, array_flip(array_keys($header_params))),
                array_flip(['templateID']),
            ),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Replace the elemental content of a journey-scoped notification template. Overwrites all elements in the template draft with the provided content.
     *
     * @param string $notificationID Path param: Notification template id
     * @param array{
     *   templateID: string,
     *   content: Content|ContentShape,
     *   state?: NotificationTemplateState|value-of<NotificationTemplateState>,
     * }|TemplatePutContentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentMutationResponse>
     *
     * @throws APIException
     */
    public function putContent(
        string $notificationID,
        array|TemplatePutContentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplatePutContentParams::parseRequest(
            $params,
            $requestOptions,
        );
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: [
                'journeys/%1$s/templates/%2$s/content', $templateID, $notificationID,
            ],
            body: (object) array_diff_key($parsed, array_flip(['templateID'])),
            options: $options,
            convert: NotificationContentMutationResponse::class,
        );
    }

    /**
     * @api
     *
     * Set locale-specific content overrides for a journey-scoped notification template. Each element override must reference an existing element by ID.
     *
     * @param string $localeID Path param: Locale code (e.g., `es`, `fr`, `pt-BR`).
     * @param array{
     *   templateID: string,
     *   notificationID: string,
     *   elements: list<Element|ElementShape>,
     *   state?: NotificationTemplateState|value-of<NotificationTemplateState>,
     * }|TemplatePutLocaleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentMutationResponse>
     *
     * @throws APIException
     */
    public function putLocale(
        string $localeID,
        array|TemplatePutLocaleParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplatePutLocaleParams::parseRequest(
            $params,
            $requestOptions,
        );
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);
        $notificationID = $parsed['notificationID'];
        unset($parsed['notificationID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: [
                'journeys/%1$s/templates/%2$s/locales/%3$s',
                $templateID,
                $notificationID,
                $localeID,
            ],
            body: (object) array_diff_key(
                $parsed,
                array_flip(['templateID', 'notificationID'])
            ),
            options: $options,
            convert: NotificationContentMutationResponse::class,
        );
    }

    /**
     * @api
     *
     * Replaces the draft content of one journey's notification template. Publish it before send nodes referencing it render the change.
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

    /**
     * @api
     *
     * Returns the Elemental elements and version of a journey-scoped template's content. Compare versions to see what changed between publishes.
     *
     * @param string $notificationID Path param: Notification template id
     * @param array{
     *   templateID: string, version?: string
     * }|TemplateRetrieveContentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentGetResponse>
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $notificationID,
        array|TemplateRetrieveContentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateRetrieveContentParams::parseRequest(
            $params,
            $requestOptions,
        );
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'journeys/%1$s/templates/%2$s/content', $templateID, $notificationID,
            ],
            query: $parsed,
            options: $options,
            convert: NotificationContentGetResponse::class,
        );
    }
}
