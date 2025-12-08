<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\TenantsContract;
use Courier\Services\Tenants\PreferencesService;
use Courier\Services\Tenants\TemplatesService;
use Courier\Tenants\DefaultPreferences;
use Courier\Tenants\Tenant;
use Courier\Tenants\TenantListParams;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersParams;
use Courier\Tenants\TenantListUsersResponse;
use Courier\Tenants\TenantUpdateParams;

final class TenantsService implements TenantsContract
{
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
        $this->preferences = new PreferencesService($client);
        $this->templates = new TemplatesService($client);
    }

    /**
     * @api
     *
     * Get a Tenant
     *
     * @throws APIException
     */
    public function retrieve(
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): Tenant {
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
     * @param array{
     *   name: string,
     *   brand_id?: string|null,
     *   default_preferences?: array{
     *     items?: list<array<mixed>>|null
     *   }|DefaultPreferences|null,
     *   parent_tenant_id?: string|null,
     *   properties?: array<string,mixed>|null,
     *   user_profile?: array<string,mixed>|null,
     * }|TenantUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $tenantID,
        array|TenantUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Tenant {
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
     *   cursor?: string|null, limit?: int|null, parent_tenant_id?: string|null
     * }|TenantListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|TenantListParams $params,
        ?RequestOptions $requestOptions = null
    ): TenantListResponse {
        [$parsed, $options] = TenantListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'tenants',
            query: $parsed,
            options: $options,
            convert: TenantListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a Tenant
     *
     * @throws APIException
     */
    public function delete(
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): mixed {
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
     * @param array{
     *   cursor?: string|null, limit?: int|null
     * }|TenantListUsersParams $params
     *
     * @throws APIException
     */
    public function listUsers(
        string $tenantID,
        array|TenantListUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): TenantListUsersResponse {
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
