<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Core\Exceptions\APIException;
use Courier\InboundBulkMessage\InboundBulkContentMessage;
use Courier\InboundBulkMessage\InboundBulkTemplateMessage;
use Courier\InboundBulkMessageUser;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface BulkContract
{
    /**
     * @api
     *
     * @param list<InboundBulkMessageUser> $users
     *
     * @throws APIException
     */
    public function addUsers(
        string $jobID,
        $users,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function addUsersRaw(
        string $jobID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param InboundBulkTemplateMessage|InboundBulkContentMessage $message
     *
     * @throws APIException
     */
    public function createJob(
        $message,
        ?RequestOptions $requestOptions = null
    ): BulkNewJobResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createJobRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkNewJobResponse;

    /**
     * @api
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of users added to the bulk job
     *
     * @throws APIException
     */
    public function listUsers(
        string $jobID,
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): BulkListUsersResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listUsersRaw(
        string $jobID,
        array $params,
        ?RequestOptions $requestOptions = null
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
