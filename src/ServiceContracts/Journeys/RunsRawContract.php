<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Journeys;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyRunListResponse;
use Courier\Journeys\JourneyRunResponse;
use Courier\Journeys\JourneyRunStepsResponse;
use Courier\Journeys\Runs\RunListParams;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface RunsRawContract
{
    /**
     * @api
     *
     * @param string $runID a unique identifier representing the Journey run
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyRunResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $runID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RunListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyRunListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|RunListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $runID a unique identifier representing the Journey run
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyRunStepsResponse>
     *
     * @throws APIException
     */
    public function listSteps(
        string $runID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
