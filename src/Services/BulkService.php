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
     * Get Bulk Job Users
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
     * Get a bulk job
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
     * Run a bulk job
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
