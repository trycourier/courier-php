<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Bulk\BulkAddUsersParams;
use Courier\Bulk\BulkCreateJobParams;
use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersParams;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Bulk\InboundBulkMessage;
use Courier\Bulk\InboundBulkMessageUser;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\BulkRawContract;

/**
 * @phpstan-import-type InboundBulkMessageUserShape from \Courier\Bulk\InboundBulkMessageUser
 * @phpstan-import-type InboundBulkMessageShape from \Courier\Bulk\InboundBulkMessage
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class BulkRawService implements BulkRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @param array{
     *   users: list<InboundBulkMessageUser|InboundBulkMessageUserShape>
     * }|BulkAddUsersParams $params
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
    ): BaseResponse {
        [$parsed, $options] = BulkAddUsersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['bulk/%1$s', $jobID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
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
     * @param array{
     *   message: InboundBulkMessage|InboundBulkMessageShape
     * }|BulkCreateJobParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkNewJobResponse>
     *
     * @throws APIException
     */
    public function createJob(
        array|BulkCreateJobParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BulkCreateJobParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'bulk',
            body: (object) $parsed,
            options: $options,
            convert: BulkNewJobResponse::class,
        );
    }

    /**
     * @api
     *
     * Get Bulk Job Users
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param array{cursor?: string|null}|BulkListUsersParams $params
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
    ): BaseResponse {
        [$parsed, $options] = BulkListUsersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['bulk/%1$s/users', $jobID],
            query: $parsed,
            options: $options,
            convert: BulkListUsersResponse::class,
        );
    }

    /**
     * @api
     *
     * Get a bulk job
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['bulk/%1$s', $jobID],
            options: $requestOptions,
            convert: BulkGetJobResponse::class,
        );
    }

    /**
     * @api
     *
     * Run a bulk job
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['bulk/%1$s/run', $jobID],
            options: $requestOptions,
            convert: null,
        );
    }
}
