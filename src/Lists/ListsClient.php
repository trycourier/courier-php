<?php

namespace Courier\Lists;

use Courier\Core\Client\RawClient;
use Courier\Lists\Requests\GetAllListsRequest;
use Courier\Lists\Types\ListGetAllResponse;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Lists\Types\List_;
use Courier\Lists\Types\ListPutParams;
use Courier\Lists\Requests\GetSubscriptionForListRequest;
use Courier\Lists\Types\ListGetSubscriptionsResponse;
use Courier\Lists\Requests\SubscribeUsersToListRequest;
use Courier\Lists\Requests\AddSubscribersToList;
use Courier\Lists\Requests\SubscribeUserToListRequest;

class ListsClient
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
     * Returns all of the lists, with the ability to filter based on a pattern.
     *
     * @param GetAllListsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ListGetAllResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function list(GetAllListsRequest $request, ?array $options = null): ListGetAllResponse
    {
        $query = [];
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        if ($request->pattern != null) {
            $query['pattern'] = $request->pattern;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ListGetAllResponse::fromJson($json);
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
     * Returns a list based on the list ID provided.
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return List_
     * @throws CourierException
     * @throws CourierApiException
     */
    public function get(string $listId, ?array $options = null): List_
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return List_::fromJson($json);
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
     * Create or replace an existing list with the supplied values.
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param ListPutParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return List_
     * @throws CourierException
     * @throws CourierApiException
     */
    public function update(string $listId, ListPutParams $request, ?array $options = null): List_
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return List_::fromJson($json);
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
     * Delete a list by list ID.
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function delete(string $listId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId",
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
     * Restore a previously deleted list.
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function restore(string $listId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId/restore",
                    method: HttpMethod::PUT,
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
     * Get the list's subscriptions.
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param GetSubscriptionForListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ListGetSubscriptionsResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getSubscribers(string $listId, GetSubscriptionForListRequest $request, ?array $options = null): ListGetSubscriptionsResponse
    {
        $query = [];
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId/subscriptions",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ListGetSubscriptionsResponse::fromJson($json);
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
     * Subscribes the users to the list, overwriting existing subscriptions. If the list does not exist, it will be automatically created.
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param SubscribeUsersToListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function updateSubscribers(string $listId, SubscribeUsersToListRequest $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId/subscriptions",
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
     * Subscribes additional users to the list, without modifying existing subscriptions. If the list does not exist, it will be automatically created.
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param AddSubscribersToList $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function addSubscribers(string $listId, AddSubscribersToList $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId/subscriptions",
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
     * Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param string $userId A unique identifier representing the recipient associated with the list
     * @param SubscribeUserToListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function subscribe(string $listId, string $userId, SubscribeUserToListRequest $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId/subscriptions/$userId",
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
     * Delete a subscription to a list by list ID and user ID.
     *
     * @param string $listId A unique identifier representing the list you wish to retrieve.
     * @param string $userId A unique identifier representing the recipient associated with the list
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function unsubscribe(string $listId, string $userId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/lists/$listId/subscriptions/$userId",
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
}
