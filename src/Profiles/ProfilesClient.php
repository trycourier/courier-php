<?php

namespace Courier\Profiles;

use Courier\Core\Client\RawClient;
use Courier\Profiles\Types\ProfileGetResponse;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Profiles\Requests\MergeProfileRequest;
use Courier\Profiles\Types\MergeProfileResponse;
use Courier\Profiles\Requests\ReplaceProfileRequest;
use Courier\Profiles\Types\ReplaceProfileResponse;
use Courier\Profiles\Types\UserProfilePatch;
use Courier\Core\Json\JsonSerializer;
use Courier\Profiles\Requests\GetListSubscriptionsRequest;
use Courier\Profiles\Types\GetListSubscriptionsResponse;
use Courier\Profiles\Types\SubscribeToListsRequest;
use Courier\Profiles\Types\SubscribeToListsResponse;
use Courier\Profiles\Types\DeleteListSubscriptionResponse;

class ProfilesClient
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
     * Returns the specified user profile.
     *
     * @param string $userId A unique identifier representing the user associated with the requested profile.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ProfileGetResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function get(string $userId, ?array $options = null): ProfileGetResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/profiles/$userId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ProfileGetResponse::fromJson($json);
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
     * Merge the supplied values with an existing profile or create a new profile if one doesn't already exist.
     *
     * @param string $userId A unique identifier representing the user associated with the requested profile.
     * @param MergeProfileRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return MergeProfileResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function create(string $userId, MergeProfileRequest $request, ?array $options = null): MergeProfileResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/profiles/$userId",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MergeProfileResponse::fromJson($json);
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
     * When using `PUT`, be sure to include all the key-value pairs required by the recipient's profile.
     * Any key-value pairs that exist in the profile but fail to be included in the `PUT` request will be
     * removed from the profile. Remember, a `PUT` update is a full replacement of the data. For partial updates,
     * use the [Patch](https://www.courier.com/docs/reference/profiles/patch/) request.
     *
     * @param string $userId A unique identifier representing the user associated with the requested profile.
     * @param ReplaceProfileRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ReplaceProfileResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function replace(string $userId, ReplaceProfileRequest $request, ?array $options = null): ReplaceProfileResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/profiles/$userId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ReplaceProfileResponse::fromJson($json);
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
     * @param string $userId A unique identifier representing the user associated with the requested profile.
     * @param array<UserProfilePatch> $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function mergeProfile(string $userId, array $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/profiles/$userId",
                    method: HttpMethod::PATCH,
                    body: JsonSerializer::serializeArray($request, [UserProfilePatch::class]),
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
     * Deletes the specified user profile.
     *
     * @param string $userId A unique identifier representing the user associated with the requested profile.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function delete(string $userId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/profiles/$userId",
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
     * Returns the subscribed lists for a specified user.
     *
     * @param string $userId A unique identifier representing the user associated with the requested profile.
     * @param GetListSubscriptionsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return GetListSubscriptionsResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getListSubscriptions(string $userId, GetListSubscriptionsRequest $request, ?array $options = null): GetListSubscriptionsResponse
    {
        $query = [];
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/profiles/$userId/lists",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return GetListSubscriptionsResponse::fromJson($json);
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
     * Subscribes the given user to one or more lists. If the list does not exist, it will be created.
     *
     * @param string $userId A unique identifier representing the user associated with the requested profile.
     * @param SubscribeToListsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return SubscribeToListsResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function subscribeToLists(string $userId, SubscribeToListsRequest $request, ?array $options = null): SubscribeToListsResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/profiles/$userId/lists",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return SubscribeToListsResponse::fromJson($json);
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
     * Removes all list subscriptions for given user.
     *
     * @param string $userId A unique identifier representing the user associated with the requested profile.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return DeleteListSubscriptionResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function deleteListSubscription(string $userId, ?array $options = null): DeleteListSubscriptionResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/profiles/$userId/lists",
                    method: HttpMethod::DELETE,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return DeleteListSubscriptionResponse::fromJson($json);
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
