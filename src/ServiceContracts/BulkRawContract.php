<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Bulk\BulkAddUsersParams;
use Courier\Bulk\BulkCreateJobParams;
use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersParams;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface BulkRawContract
{
    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param array<string,mixed>|BulkAddUsersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addUsers(
        string $jobID,
        array|BulkAddUsersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BulkCreateJobParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkNewJobResponse>
     *
     * @throws APIException
     */
    public function createJob(
        array|BulkCreateJobParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param array<string,mixed>|BulkListUsersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkListUsersResponse>
     *
     * @throws APIException
     */
    public function listUsers(
        string $jobID,
        array|BulkListUsersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkGetJobResponse>
     *
     * @throws APIException
     */
    public function retrieveJob(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function runJob(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
