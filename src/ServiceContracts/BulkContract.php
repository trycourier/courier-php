<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Bulk\BulkAddUsersParams;
use Courier\Bulk\BulkCreateJobParams;
use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersParams;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface BulkContract
{
    /**
     * @api
     *
     * @param array<mixed>|BulkAddUsersParams $params
     *
     * @throws APIException
     */
    public function addUsers(
        string $jobID,
        array|BulkAddUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|BulkCreateJobParams $params
     *
     * @throws APIException
     */
    public function createJob(
        array|BulkCreateJobParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkNewJobResponse;

    /**
     * @api
     *
     * @param array<mixed>|BulkListUsersParams $params
     *
     * @throws APIException
     */
    public function listUsers(
        string $jobID,
        array|BulkListUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkListUsersResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BulkGetJobResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function runJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
