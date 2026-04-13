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
use Courier\Notifications\NotificationListParams;
use Courier\Notifications\NotificationListResponse;
use Courier\Notifications\NotificationListVersionsParams;
use Courier\Notifications\NotificationPublishParams;
use Courier\Notifications\NotificationPutContentParams;
use Courier\Notifications\NotificationPutContentParams\Content;
use Courier\Notifications\NotificationPutElementParams;
use Courier\Notifications\NotificationPutLocaleParams;
use Courier\Notifications\NotificationPutLocaleParams\Element;
use Courier\Notifications\NotificationReplaceParams;
use Courier\Notifications\NotificationRetrieveContentParams;
use Courier\Notifications\NotificationRetrieveParams;
use Courier\Notifications\NotificationTemplateGetResponse;
use Courier\Notifications\NotificationTemplatePayload;
use Courier\Notifications\NotificationTemplateState;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\NotificationsRawContract;

/**
 * @phpstan-import-type ContentShape from \Courier\Notifications\NotificationPutContentParams\Content
 * @phpstan-import-type ElementShape from \Courier\Notifications\NotificationPutLocaleParams\Element
 * @phpstan-import-type NotificationTemplatePayloadShape from \Courier\Notifications\NotificationTemplatePayload
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
     * @param array{
     *   notification: NotificationTemplatePayload|NotificationTemplatePayloadShape,
     *   state?: State|value-of<State>,
     * }|NotificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateGetResponse>
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'notifications',
            body: (object) $parsed,
            options: $options,
            convert: NotificationTemplateGetResponse::class,
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
     * @return BaseResponse<NotificationTemplateGetResponse>
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
            convert: NotificationTemplateGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List notification templates in your workspace.
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
     * Archive a notification template.
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
     * List versions of a notification template.
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
     * @param string $id template ID (nt_ prefix)
     * @param array{version?: string}|NotificationPublishParams $params
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['notifications/%1$s/publish', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Replace the elemental content of a notification template. Overwrites all elements in the template with the provided content. Only supported for V2 (elemental) templates.
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
     * Update a single element within a notification template. Only supported for V2 (elemental) templates.
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
     * Set locale-specific content overrides for a notification template. Each element override must reference an existing element by ID. Only supported for V2 (elemental) templates.
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
     * Replace a notification template. All fields are required.
     *
     * @param string $id template ID (nt_ prefix)
     * @param array{
     *   notification: NotificationTemplatePayload|NotificationTemplatePayloadShape,
     *   state?: NotificationReplaceParams\State|value-of<NotificationReplaceParams\State>,
     * }|NotificationReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateGetResponse>
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
            convert: NotificationTemplateGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the content of a notification template. The response shape depends on whether the template uses V1 (blocks/channels) or V2 (elemental) content. Use the `version` query parameter to select draft, published, or a specific historical version.
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
