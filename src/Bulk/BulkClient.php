<?php

namespace Courier\Bulk;

use Courier\Core\Client\RawClient;
use Courier\Bulk\Requests\BulkCreateJobParams;
use Courier\Bulk\Types\BulkCreateJobResponse;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Bulk\Types\BulkIngestUsersParams;
use Courier\Bulk\Types\BulkGetJobResponse;
use Courier\Bulk\Requests\BulkGetUsersParams;
use Courier\Bulk\Types\BulkGetJobUsersResponse;

class BulkClient
{
    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     */
    public function __construct(
        RawClient $client,
    ) {
        $this->client = $client;
    }

    /**
     * @param BulkCreateJobParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return BulkCreateJobResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function createJob(BulkCreateJobParams $request, ?array $options = null): BulkCreateJobResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/bulk",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return BulkCreateJobResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Ingest user data into a Bulk Job
     *
     * @param string $jobId A unique identifier representing the bulk job
     * @param BulkIngestUsersParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function ingestUsers(string $jobId, BulkIngestUsersParams $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/bulk/$jobId",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Run a bulk job
     *
     * @param string $jobId A unique identifier representing the bulk job
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function runJob(string $jobId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/bulk/$jobId/run",
                    method: HttpMethod::POST,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get a bulk job
     *
     * @param string $jobId A unique identifier representing the bulk job
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return BulkGetJobResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getJob(string $jobId, ?array $options = null): BulkGetJobResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/bulk/$jobId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return BulkGetJobResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get Bulk Job Users
     *
     * @param string $jobId A unique identifier representing the bulk job
     * @param BulkGetUsersParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return BulkGetJobUsersResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getUsers(string $jobId, BulkGetUsersParams $request, ?array $options = null): BulkGetJobUsersResponse
    {
        $query = [];
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/bulk/$jobId/users",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return BulkGetJobUsersResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
