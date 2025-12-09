<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\TenantsContract;
use Courier\Services\Tenants\PreferencesService;
use Courier\Services\Tenants\TemplatesService;
use Courier\Tenants\DefaultPreferences;
use Courier\Tenants\SubscriptionTopicNew\Status;
use Courier\Tenants\Tenant;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersResponse;

final class TenantsService implements TenantsContract
{
    /**
     * @api
     */
    public TenantsRawService $raw;

    /**
     * @api
     */
    public PreferencesService $preferences;

    /**
     * @api
     */
    public TemplatesService $templates;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TenantsRawService($client);
        $this->preferences = new PreferencesService($client);
        $this->templates = new TemplatesService($client);
    }

    /**
     * @api
     *
     * Get a Tenant
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     *
     * @throws APIException
     */
    public function retrieve(
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): Tenant {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($tenantID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create or Replace a Tenant
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     * @param string $name name of the tenant
     * @param string|null $brandID brand to be used for the account when one is not specified by the send call
     * @param array{
     *   items?: list<array{
     *     status: 'OPTED_OUT'|'OPTED_IN'|'REQUIRED'|Status,
     *     customRouting?: list<'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification>|null,
     *     hasCustomRouting?: bool|null,
     *     id: string,
     *   }>|null,
     * }|DefaultPreferences|null $defaultPreferences Defines the preferences used for the tenant when the user hasn't specified their own
     * @param string|null $parentTenantID tenant's parent id (if any)
     * @param array<string,mixed>|null $properties arbitrary properties accessible to a template
     * @param array<string,mixed>|null $userProfile a user profile object merged with user profile on send
     *
     * @throws APIException
     */
    public function update(
        string $tenantID,
        string $name,
        ?string $brandID = null,
        array|DefaultPreferences|null $defaultPreferences = null,
        ?string $parentTenantID = null,
        ?array $properties = null,
        ?array $userProfile = null,
        ?RequestOptions $requestOptions = null,
    ): Tenant {
        $params = [
            'name' => $name,
            'brandID' => $brandID,
            'defaultPreferences' => $defaultPreferences,
            'parentTenantID' => $parentTenantID,
            'properties' => $properties,
            'userProfile' => $userProfile,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($tenantID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a List of Tenants
     *
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of tenants to return
     * (defaults to 20, maximum value of 100)
     * @param string|null $parentTenantID Filter the list of tenants by parent_id
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $parentTenantID = null,
        ?RequestOptions $requestOptions = null,
    ): TenantListResponse {
        $params = [
            'cursor' => $cursor,
            'limit' => $limit,
            'parentTenantID' => $parentTenantID,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a Tenant
     *
     * @param string $tenantID id of the tenant to be deleted
     *
     * @throws APIException
     */
    public function delete(
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($tenantID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get Users in Tenant
     *
     * @param string $tenantID id of the tenant for user membership
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of accounts to return
     * (defaults to 20, maximum value of 100)
     *
     * @throws APIException
     */
    public function listUsers(
        string $tenantID,
        ?string $cursor = null,
        ?int $limit = null,
        ?RequestOptions $requestOptions = null,
    ): TenantListUsersResponse {
        $params = ['cursor' => $cursor, 'limit' => $limit];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listUsers($tenantID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
