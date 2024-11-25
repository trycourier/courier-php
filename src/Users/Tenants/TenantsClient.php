<?php

namespace Courier\Users\Tenants;

use Courier\Core\Client\RawClient;
use Courier\Users\Tenants\Requests\AddUserToMultipleTenantsParams;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Users\Tenants\Requests\AddUserToSingleTenantsParams;
use Courier\Users\Tenants\Requests\ListTenantsForUserParams;
use Courier\Users\Tenants\Types\ListTenantsForUserResponse;
use JsonException;

class TenantsClient
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
     * This endpoint is used to add a user to
     * multiple tenants in one call.
     * A custom profile can also be supplied for each tenant.
     * This profile will be merged with the user's main
     * profile when sending to the user with that tenant.
     *
     * @param string $userId The user's ID. This can be any uniquely identifiable string.
     * @param AddUserToMultipleTenantsParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function addMultple(string $userId, AddUserToMultipleTenantsParams $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "users/$userId/tenants",
                    method: HttpMethod::PUT,
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
     * This endpoint is used to add a single tenant.
     *
     * A custom profile can also be supplied with the tenant.
     * This profile will be merged with the user's main profile
     * when sending to the user with that tenant.
     *
     * @param string $userId Id of the user to be added to the supplied tenant.
     * @param string $tenantId Id of the tenant the user should be added to.
     * @param AddUserToSingleTenantsParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function add(string $userId, string $tenantId, AddUserToSingleTenantsParams $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "users/$userId/tenants/$tenantId",
                    method: HttpMethod::PUT,
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
     * Removes a user from any tenants they may have been associated with.
     *
     * @param string $userId Id of the user to be removed from the supplied tenant.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function removeAll(string $userId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "users/$userId/tenants",
                    method: HttpMethod::DELETE,
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
     * Removes a user from the supplied tenant.
     *
     * @param string $userId Id of the user to be removed from the supplied tenant.
     * @param string $tenantId Id of the tenant the user should be removed from.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function remove(string $userId, string $tenantId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "users/$userId/tenants/$tenantId",
                    method: HttpMethod::DELETE,
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
     * Returns a paginated list of user tenant associations.
     *
     * @param string $userId Id of the user to retrieve all associated tenants for.
     * @param ListTenantsForUserParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ListTenantsForUserResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function list(string $userId, ListTenantsForUserParams $request, ?array $options = null): ListTenantsForUserResponse
    {
        $query = [];
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "users/$userId/tenants",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ListTenantsForUserResponse::fromJson($json);
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
