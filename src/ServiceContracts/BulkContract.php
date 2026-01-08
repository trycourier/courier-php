<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Bulk\InboundBulkMessage;
use Courier\Bulk\InboundBulkMessageUser;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type InboundBulkMessageUserShape from \Courier\Bulk\InboundBulkMessageUser
 * @phpstan-import-type InboundBulkMessageShape from \Courier\Bulk\InboundBulkMessage
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface BulkContract
{
    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param list<InboundBulkMessageUser|InboundBulkMessageUserShape> $users
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addUsers(
        string $jobID,
        array $users,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param InboundBulkMessage|InboundBulkMessageShape $message Bulk message definition. Supports two formats:
     * - V1 format: Requires `event` field (event ID or notification ID)
     * - V2 format: Optionally use `template` (notification ID) or `content` (Elemental content) in addition to `event`
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createJob(
        InboundBulkMessage|array $message,
        RequestOptions|array|null $requestOptions = null,
    ): BulkNewJobResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param string|null $cursor A unique identifier that allows for fetching the next set of users added to the bulk job
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listUsers(
        string $jobID,
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null,
    ): BulkListUsersResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveJob(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BulkGetJobResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function runJob(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
