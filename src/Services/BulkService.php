<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Bulk\BulkAddUsersParams;
use Courier\Bulk\BulkCreateJobParams;
use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersParams;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\InboundBulkMessage\InboundBulkContentMessage;
use Courier\InboundBulkMessage\InboundBulkTemplateMessage;
use Courier\InboundBulkMessageUser;
use Courier\RequestOptions;
use Courier\ServiceContracts\BulkContract;

use const Courier\Core\OMIT as omit;

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
     * @param list<InboundBulkMessageUser> $users
     *
     * @throws APIException
     */
    public function addUsers(
        string $jobID,
        $users,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['users' => $users];

        return $this->addUsersRaw($jobID, $params, $requestOptions);
    }

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
    ): mixed {
        [$parsed, $options] = BulkAddUsersParams::parseRequest(
            $params,
            $requestOptions
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
     * @param InboundBulkTemplateMessage|InboundBulkContentMessage $message
     *
     * @throws APIException
     */
    public function createJob(
        $message,
        ?RequestOptions $requestOptions = null
    ): BulkNewJobResponse {
        $params = ['message' => $message];

        return $this->createJobRaw($params, $requestOptions);
    }

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
    ): BulkNewJobResponse {
        [$parsed, $options] = BulkCreateJobParams::parseRequest(
            $params,
            $requestOptions
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
     * @param string|null $cursor A unique identifier that allows for fetching the next set of users added to the bulk job
     *
     * @throws APIException
     */
    public function listUsers(
        string $jobID,
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): BulkListUsersResponse {
        $params = ['cursor' => $cursor];

        return $this->listUsersRaw($jobID, $params, $requestOptions);
    }

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
    ): BulkListUsersResponse {
        [$parsed, $options] = BulkListUsersParams::parseRequest(
            $params,
            $requestOptions
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
