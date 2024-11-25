<?php

namespace Courier\Users\Preferences;

use Courier\Core\Client\RawClient;
use Courier\Users\Preferences\Requests\UserPreferencesParams;
use Courier\Users\Preferences\Types\UserPreferencesListResponse;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Users\Preferences\Requests\UserPreferencesTopicParams;
use Courier\Users\Preferences\Types\UserPreferencesGetResponse;
use Courier\Users\Preferences\Requests\UserPreferencesUpdateParams;
use Courier\Users\Preferences\Types\UserPreferencesUpdateResponse;

class PreferencesClient
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
     * Fetch all user preferences.
     *
     * @param string $userId A unique identifier associated with the user whose preferences you wish to retrieve.
     * @param UserPreferencesParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return UserPreferencesListResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function list(string $userId, UserPreferencesParams $request, ?array $options = null): UserPreferencesListResponse
    {
        $query = [];
        if ($request->tenantId != null) {
            $query['tenant_id'] = $request->tenantId;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/users/$userId/preferences",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return UserPreferencesListResponse::fromJson($json);
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
     * Fetch user preferences for a specific subscription topic.
     *
     * @param string $userId A unique identifier associated with the user whose preferences you wish to retrieve.
     * @param string $topicId A unique identifier associated with a subscription topic.
     * @param UserPreferencesTopicParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return UserPreferencesGetResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function get(string $userId, string $topicId, UserPreferencesTopicParams $request, ?array $options = null): UserPreferencesGetResponse
    {
        $query = [];
        if ($request->tenantId != null) {
            $query['tenant_id'] = $request->tenantId;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/users/$userId/preferences/$topicId",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return UserPreferencesGetResponse::fromJson($json);
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
     * Update or Create user preferences for a specific subscription topic.
     *
     * @param string $userId A unique identifier associated with the user whose preferences you wish to retrieve.
     * @param string $topicId A unique identifier associated with a subscription topic.
     * @param UserPreferencesUpdateParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return UserPreferencesUpdateResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function update(string $userId, string $topicId, UserPreferencesUpdateParams $request, ?array $options = null): UserPreferencesUpdateResponse
    {
        $query = [];
        if ($request->tenantId != null) {
            $query['tenant_id'] = $request->tenantId;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/users/$userId/preferences/$topicId",
                    method: HttpMethod::PUT,
                    query: $query,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return UserPreferencesUpdateResponse::fromJson($json);
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
