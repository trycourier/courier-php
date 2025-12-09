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

interface BulkRawContract
{
    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param array<mixed>|BulkAddUsersParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addUsers(
        string $jobID,
        array|BulkAddUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|BulkCreateJobParams $params
     *
     * @return BaseResponse<BulkNewJobResponse>
     *
     * @throws APIException
     */
    public function createJob(
        array|BulkCreateJobParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param array<mixed>|BulkListUsersParams $params
     *
     * @return BaseResponse<BulkListUsersResponse>
     *
     * @throws APIException
     */
    public function listUsers(
        string $jobID,
        array|BulkListUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     *
     * @return BaseResponse<BulkGetJobResponse>
     *
     * @throws APIException
     */
    public function retrieveJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function runJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
