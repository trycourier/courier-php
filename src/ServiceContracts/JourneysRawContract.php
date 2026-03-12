<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyInvokeParams;
use Courier\Journeys\JourneyListParams;
use Courier\Journeys\JourneysInvokeResponse;
use Courier\Journeys\JourneysListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface JourneysRawContract
{
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
     * @param string $templateID A unique identifier representing the journey template to be invoked. This could be the Journey Template ID or the Journey Template Alias.
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
}
