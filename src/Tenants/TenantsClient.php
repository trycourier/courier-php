<?php

namespace Courier\Tenants;

use Courier\Core\Client\RawClient;
use Courier\Tenants\Requests\TenantCreateOrReplaceParams;
use Courier\Tenants\Types\Tenant;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Tenants\Requests\ListTenantParams;
use Courier\Tenants\Types\TenantListResponse;
use Courier\Tenants\Requests\ListUsersForTenantParams;
use Courier\Tenants\Types\ListUsersForTenantResponse;
use Courier\Tenants\Types\SubscriptionTopicNew;
use Courier\Tenants\Types\GetTemplateByTenantResponse;
use Courier\Tenants\Requests\GetTemplateListByTenantParams;
use Courier\Tenants\Types\ListTemplatesByTenantResponse;

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
     * @param string $tenantId A unique identifier representing the tenant to be returned.
     * @param TenantCreateOrReplaceParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return Tenant
     * @throws CourierException
     * @throws CourierApiException
     */
    public function createOrReplace(string $tenantId, TenantCreateOrReplaceParams $request, ?array $options = null): Tenant
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/tenants/$tenantId",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return Tenant::fromJson($json);
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
     * @param string $tenantId A unique identifier representing the tenant to be returned.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return Tenant
     * @throws CourierException
     * @throws CourierApiException
     */
    public function get(string $tenantId, ?array $options = null): Tenant
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/tenants/$tenantId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return Tenant::fromJson($json);
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
     * @param ListTenantParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return TenantListResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function list(ListTenantParams $request, ?array $options = null): TenantListResponse
    {
        $query = [];
        if ($request->parentTenantId != null) {
            $query['parent_tenant_id'] = $request->parentTenantId;
        }
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
                    path: "/tenants",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return TenantListResponse::fromJson($json);
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
     * @param string $tenantId Id of the tenant to be deleted.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function delete(string $tenantId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/tenants/$tenantId",
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
     * @param string $tenantId Id of the tenant for user membership.
     * @param ListUsersForTenantParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ListUsersForTenantResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getUsersByTenant(string $tenantId, ListUsersForTenantParams $request, ?array $options = null): ListUsersForTenantResponse
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
                    path: "/tenants/$tenantId/users",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ListUsersForTenantResponse::fromJson($json);
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
     * @param string $tenantId Id of the tenant to update the default preferences for.
     * @param string $topicId Id fo the susbcription topic you want to have a default preference for.
     * @param SubscriptionTopicNew $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function createOrReplaceDefaultPreferencesForTopic(string $tenantId, string $topicId, SubscriptionTopicNew $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/tenants/$tenantId/default_preferences/items/$topicId",
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
     * @param string $tenantId Id of the tenant to update the default preferences for.
     * @param string $topicId Id fo the susbcription topic you want to have a default preference for.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function removeDefaultPreferencesForTopic(string $tenantId, string $topicId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/tenants/$tenantId/default_preferences/items/$topicId",
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
     * @param string $tenantId Id of the tenant for which to retrieve the template.
     * @param string $templateId Id of the template to be retrieved.
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return GetTemplateByTenantResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getTemplateByTenant(string $tenantId, string $templateId, ?array $options = null): GetTemplateByTenantResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/tenants/$tenantId/templates/$templateId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return GetTemplateByTenantResponse::fromJson($json);
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
     * @param string $tenantId Id of the tenant for which to retrieve the templates.
     * @param GetTemplateListByTenantParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ListTemplatesByTenantResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getTemplateListByTenant(string $tenantId, GetTemplateListByTenantParams $request, ?array $options = null): ListTemplatesByTenantResponse
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
                    path: "/tenants/$tenantId/templates",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ListTemplatesByTenantResponse::fromJson($json);
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
