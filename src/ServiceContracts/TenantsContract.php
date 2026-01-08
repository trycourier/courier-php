<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\DefaultPreferences;
use Courier\Tenants\Tenant;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersResponse;

/**
 * @phpstan-import-type DefaultPreferencesShape from \Courier\Tenants\DefaultPreferences
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TenantsContract
{
    /**
     * @api
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $tenantID,
        RequestOptions|array|null $requestOptions = null
    ): Tenant;

    /**
     * @api
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     * @param string $name name of the tenant
     * @param string|null $brandID brand to be used for the account when one is not specified by the send call
     * @param DefaultPreferences|DefaultPreferencesShape|null $defaultPreferences defines the preferences used for the tenant when the user hasn't specified their own
     * @param string|null $parentTenantID tenant's parent id (if any)
     * @param array<string,mixed>|null $properties arbitrary properties accessible to a template
     * @param array<string,mixed>|null $userProfile a user profile object merged with user profile on send
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $tenantID,
        string $name,
        ?string $brandID = null,
        DefaultPreferences|array|null $defaultPreferences = null,
        ?string $parentTenantID = null,
        ?array $properties = null,
        ?array $userProfile = null,
        RequestOptions|array|null $requestOptions = null,
    ): Tenant;

    /**
     * @api
     *
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of tenants to return
     * (defaults to 20, maximum value of 100)
     * @param string|null $parentTenantID Filter the list of tenants by parent_id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $parentTenantID = null,
        RequestOptions|array|null $requestOptions = null,
    ): TenantListResponse;

    /**
     * @api
     *
     * @param string $tenantID id of the tenant to be deleted
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $tenantID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $tenantID id of the tenant for user membership
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of accounts to return
     * (defaults to 20, maximum value of 100)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listUsers(
        string $tenantID,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): TenantListUsersResponse;
}
