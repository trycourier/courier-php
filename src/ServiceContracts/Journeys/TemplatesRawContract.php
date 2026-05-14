<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Journeys;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyTemplateGetResponse;
use Courier\Journeys\JourneyTemplateListResponse;
use Courier\Journeys\Templates\TemplateArchiveParams;
use Courier\Journeys\Templates\TemplateCreateParams;
use Courier\Journeys\Templates\TemplateListParams;
use Courier\Journeys\Templates\TemplateListVersionsParams;
use Courier\Journeys\Templates\TemplatePublishParams;
use Courier\Journeys\Templates\TemplateReplaceParams;
use Courier\Journeys\Templates\TemplateRetrieveParams;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TemplatesRawContract
{
    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param array<string,mixed>|TemplateCreateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $notificationID Journey template id
     * @param array<string,mixed>|TemplateRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param array<string,mixed>|TemplateListParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $notificationID Journey template id
     * @param array<string,mixed>|TemplateArchiveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $notificationID Journey template id
     * @param array<string,mixed>|TemplateListVersionsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $notificationID Path param: Journey template id
     * @param array<string,mixed>|TemplatePublishParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $notificationID Path param: Journey template id
     * @param array<string,mixed>|TemplateReplaceParams $params
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
    ): BaseResponse;
}
