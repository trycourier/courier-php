<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyCreateParams;
use Courier\Journeys\JourneyInvokeParams;
use Courier\Journeys\JourneyListParams;
use Courier\Journeys\JourneyPublishParams;
use Courier\Journeys\JourneyReplaceParams;
use Courier\Journeys\JourneyResponse;
use Courier\Journeys\JourneyRetrieveParams;
use Courier\Journeys\JourneysInvokeResponse;
use Courier\Journeys\JourneysListResponse;
use Courier\Journeys\JourneyVersionsListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface JourneysRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|JourneyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyResponse>
     *
     * @throws APIException
     */
    public function create(
        array|JourneyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param array<string,mixed>|JourneyRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        array|JourneyRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|JourneyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneysListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|JourneyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $templateID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID A unique identifier representing the journey to be invoked. Accepts a Journey ID or Journey Alias.
     * @param array<string,mixed>|JourneyInvokeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneysInvokeResponse>
     *
     * @throws APIException
     */
    public function invoke(
        string $templateID,
        array|JourneyInvokeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyVersionsListResponse>
     *
     * @throws APIException
     */
    public function listVersions(
        string $templateID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param array<string,mixed>|JourneyPublishParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyResponse>
     *
     * @throws APIException
     */
    public function publish(
        string $templateID,
        array|JourneyPublishParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param array<string,mixed>|JourneyReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $templateID,
        array|JourneyReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
