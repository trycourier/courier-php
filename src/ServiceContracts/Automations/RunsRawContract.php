<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Automations;

use Courier\Automations\AutomationRunListResponse;
use Courier\Automations\AutomationRunStepsResponse;
use Courier\Automations\Runs\RunListParams;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface RunsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RunListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutomationRunListResponse>
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
     * @param string $id a unique identifier representing the Automation run
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutomationRunStepsResponse>
     *
     * @throws APIException
     */
    public function listSteps(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
