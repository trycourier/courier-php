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
     * Get a Tenant
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
     * Create or Replace a Tenant
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
     * Get a List of Tenants
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
     * Delete a Tenant
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
     * Get Users in Tenant
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
