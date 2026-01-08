<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\Checks\CheckDeleteParams;
use Courier\Notifications\Checks\CheckListParams;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateParams;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface ChecksRawContract
{
    /**
     * @api
     *
     * @param string $submissionID Path param:
     * @param array<string,mixed>|CheckUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        array|CheckUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CheckListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        array|CheckListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CheckDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        array|CheckDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
