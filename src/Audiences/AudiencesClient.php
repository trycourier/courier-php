<?php

namespace Courier\Audiences;

use Courier\Core\Client\RawClient;
use Courier\Audiences\Types\Audience;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Audiences\Requests\AudienceUpdateParams;
use Courier\Audiences\Types\AudienceUpdateResponse;
use Courier\Audiences\Requests\AudienceMembersListParams;
use Courier\Audiences\Types\AudienceMemberListResponse;
use Courier\Audiences\Requests\AudiencesListParams;
use Courier\Audiences\Types\AudienceListResponse;

class AudiencesClient
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
     * Returns the specified audience by id.
     *
     * @param string $audienceId A unique identifier representing the audience_id
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return Audience
     * @throws CourierException
     * @throws CourierApiException
     */
    public function get(string $audienceId, ?array $options = null): Audience
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/audiences/$audienceId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return Audience::fromJson($json);
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
     * Creates or updates audience.
     *
     * @param string $audienceId A unique identifier representing the audience id
     * @param AudienceUpdateParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return AudienceUpdateResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function update(string $audienceId, AudienceUpdateParams $request, ?array $options = null): AudienceUpdateResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/audiences/$audienceId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return AudienceUpdateResponse::fromJson($json);
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
     * Deletes the specified audience.
     *
     * @param string $audienceId A unique identifier representing the audience id
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function delete(string $audienceId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/audiences/$audienceId",
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
     * Get list of members of an audience.
     *
     * @param string $audienceId A unique identifier representing the audience id
     * @param AudienceMembersListParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return AudienceMemberListResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function listMembers(string $audienceId, AudienceMembersListParams $request, ?array $options = null): AudienceMemberListResponse
    {
        $query = [];
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/audiences/$audienceId/members",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return AudienceMemberListResponse::fromJson($json);
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
     * Get the audiences associated with the authorization token.
     *
     * @param AudiencesListParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return AudienceListResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function listAudiences(AudiencesListParams $request, ?array $options = null): AudienceListResponse
    {
        $query = [];
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/audiences",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return AudienceListResponse::fromJson($json);
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
