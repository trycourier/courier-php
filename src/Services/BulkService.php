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
use Courier\Core\Exceptions\APIException;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\ServiceContracts\BulkContract;
use Courier\UserRecipient;

final class BulkService implements BulkContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Ingest user data into a Bulk Job
     *
     * @param array{
     *   users: list<array{
     *     data?: mixed,
     *     preferences?: array<mixed>|RecipientPreferences|null,
     *     profile?: mixed,
     *     recipient?: string|null,
     *     to?: array<mixed>|UserRecipient|null,
     *   }|InboundBulkMessageUser>,
     * }|BulkAddUsersParams $params
     *
     * @throws APIException
     */
    public function addUsers(
        string $jobID,
        array|BulkAddUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = BulkAddUsersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * Create a bulk job
     *
     * @param array{
     *   message: InboundBulkMessage|array<string,mixed>
     * }|BulkCreateJobParams $params
     *
     * @throws APIException
     */
    public function createJob(
        array|BulkCreateJobParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkNewJobResponse {
        [$parsed, $options] = BulkCreateJobParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @param array{cursor?: string|null}|BulkListUsersParams $params
     *
     * @throws APIException
     */
    public function listUsers(
        string $jobID,
        array|BulkListUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkListUsersResponse {
        [$parsed, $options] = BulkListUsersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieveJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BulkGetJobResponse {
        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function runJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['bulk/%1$s/run', $jobID],
            options: $requestOptions,
            convert: null,
        );
    }
}
