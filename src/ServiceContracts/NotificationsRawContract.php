<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationCreateParams;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListParams;
use Courier\Notifications\NotificationListResponse;
use Courier\Notifications\NotificationListVersionsParams;
use Courier\Notifications\NotificationPublishParams;
use Courier\Notifications\NotificationReplaceParams;
use Courier\Notifications\NotificationRetrieveParams;
use Courier\Notifications\NotificationTemplateGetResponse;
use Courier\Notifications\NotificationTemplateMutationResponse;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface NotificationsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|NotificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateMutationResponse>
     *
     * @throws APIException
     */
    public function create(
        array|NotificationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id template ID (nt_ prefix)
     * @param array<string,mixed>|NotificationRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|NotificationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id template ID (nt_ prefix)
     * @param array<string,mixed>|NotificationListVersionsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id template ID (nt_ prefix)
     * @param array<string,mixed>|NotificationPublishParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id template ID (nt_ prefix)
     * @param array<string,mixed>|NotificationReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationTemplateMutationResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $id,
        array|NotificationReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationGetContent>
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
