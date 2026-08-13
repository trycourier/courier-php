<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Bulk\InboundBulkMessage;
use Courier\Bulk\InboundBulkMessageUser;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\BulkContract;

/**
 * @phpstan-import-type InboundBulkMessageUserShape from \Courier\Bulk\InboundBulkMessageUser
 * @phpstan-import-type InboundBulkMessageShape from \Courier\Bulk\InboundBulkMessage
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class BulkService implements BulkContract
{
    /**
     * @api
     */
    public BulkRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BulkRawService($client);
    }

    /**
     * @api
     *
     * Ingest user data into a Bulk Job.
     *
     * **Important**: For email-based bulk jobs, each user must include `profile.email`
     * for provider routing to work correctly. The `to.email` field is not sufficient
     * for email provider routing.
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
    ): mixed {
        $params = Util::removeNulls(['users' => $users]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->addUsers($jobID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates a new bulk job for sending messages to multiple recipients.
     *
     * **Required**: `message.event` (event ID or notification ID)
     *
     * **Optional (V2 format)**: `message.template` (notification ID) or `message.content` (Elemental content)
     * can be provided to override the notification associated with the event.
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
    ): BulkNewJobResponse {
        $params = Util::removeNulls(['message' => $message]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createJob(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the users ingested into a bulk job with paging, each carrying the status Courier recorded for it and the id of the message it produced.
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
    ): BulkListUsersResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listUsers($jobID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a bulk job's message definition, its status — CREATED, PROCESSING, COMPLETED, or ERROR — and running counts of users received, messages enqueued, and failures. Poll it to follow a job through to completion.
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveJob(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BulkGetJobResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveJob($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Starts processing a bulk job, sending to every user ingested into it. Returns 204 immediately; the job runs asynchronously, so poll the job to watch its status and counts.
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function runJob(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->runJob($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
