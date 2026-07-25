<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\TenantsRawContract;
use Courier\Tenants\DefaultPreferences;
use Courier\Tenants\Tenant;
use Courier\Tenants\TenantListParams;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersParams;
use Courier\Tenants\TenantListUsersResponse;
use Courier\Tenants\TenantUpdateParams;

/**
 * @phpstan-import-type DefaultPreferencesShape from \Courier\Tenants\DefaultPreferences
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TenantsRawService implements TenantsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns one tenant with its name, parent tenant id, default preferences, properties, and the user profile applied to its members.
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Tenant>
     *
     * @throws APIException
     */
    public function retrieve(
        string $tenantID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['tenants/%1$s', $tenantID],
            options: $requestOptions,
            convert: Tenant::class,
        );
    }

    /**
     * @api
     *
     * Creates or replaces a tenant from a name, parent, brand, properties, and default preferences supplied in the request body.
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     * @param array{
     *   name: string,
     *   brandID?: string|null,
     *   defaultPreferences?: DefaultPreferences|DefaultPreferencesShape|null,
     *   parentTenantID?: string|null,
     *   properties?: array<string,mixed>|null,
     *   userProfile?: array<string,mixed>|null,
     * }|TenantUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Tenant>
     *
     * @throws APIException
     */
    public function update(
        string $tenantID,
        array|TenantUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TenantUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['tenants/%1$s', $tenantID],
            body: (object) $parsed,
            options: $options,
            convert: Tenant::class,
        );
    }

    /**
     * @api
     *
     * Lists the workspace's tenants, each carrying a name, parent tenant, properties, and default preferences. Paged.
     *
     * @param array{
     *   cursor?: string|null, limit?: int|null, parentTenantID?: string|null
     * }|TenantListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TenantListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TenantListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TenantListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'tenants',
            query: Util::array_transform_keys(
                $parsed,
                ['parentTenantID' => 'parent_tenant_id']
            ),
            options: $options,
            convert: TenantListResponse::class,
        );
    }

    /**
     * @api
     *
     * Deletes a tenant. Its members' workspace-level profiles and preferences live outside the tenant and are managed separately.
     *
     * @param string $tenantID id of the tenant to be deleted
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $tenantID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['tenants/%1$s', $tenantID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns the users belonging to a tenant with cursor paging. Use it to see who a tenant-scoped send will reach.
     *
     * @param string $tenantID id of the tenant for user membership
     * @param array{
     *   cursor?: string|null, limit?: int|null
     * }|TenantListUsersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TenantListUsersResponse>
     *
     * @throws APIException
     */
    public function listUsers(
        string $tenantID,
        array|TenantListUsersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TenantListUsersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['tenants/%1$s/users', $tenantID],
            query: $parsed,
            options: $options,
            convert: TenantListUsersResponse::class,
        );
    }
}
