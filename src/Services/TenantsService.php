<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\DefaultPreferences;
use Courier\RequestOptions;
use Courier\ServiceContracts\TenantsContract;
use Courier\Services\Tenants\DefaultPreferencesService;
use Courier\Services\Tenants\TemplatesService;
use Courier\Tenant;
use Courier\Tenants\TenantListParams;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersParams;
use Courier\Tenants\TenantListUsersResponse;
use Courier\Tenants\TenantUpdateParams;

use const Courier\Core\OMIT as omit;

final class TenantsService implements TenantsContract
{
    /**
     * @@api
     */
    public DefaultPreferencesService $defaultPreferences;

    /**
     * @@api
     */
    public TemplatesService $templates;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->defaultPreferences = new DefaultPreferencesService($client);
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
        // @phpstan-ignore-next-line;
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
     * @param string $name name of the tenant
     * @param string|null $brandID brand to be used for the account when one is not specified by the send call
     * @param DefaultPreferences|null $defaultPreferences defines the preferences used for the tenant when the user hasn't specified their own
     * @param string|null $parentTenantID tenant's parent id (if any)
     * @param array<string,
     * mixed,>|null $properties Arbitrary properties accessible to a template
     * @param array<string,
     * mixed,>|null $userProfile A user profile object merged with user profile on send
     *
     * @throws APIException
     */
    public function update(
        string $tenantID,
        $name,
        $brandID = omit,
        $defaultPreferences = omit,
        $parentTenantID = omit,
        $properties = omit,
        $userProfile = omit,
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

        return $this->updateRaw($tenantID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $tenantID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): Tenant {
        [$parsed, $options] = TenantUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of tenants to return
     * (defaults to 20, maximum value of 100)
     * @param string|null $parentTenantID Filter the list of tenants by parent_id
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        $limit = omit,
        $parentTenantID = omit,
        ?RequestOptions $requestOptions = null,
    ): TenantListResponse {
        $params = [
            'cursor' => $cursor,
            'limit' => $limit,
            'parentTenantID' => $parentTenantID,
        ];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): TenantListResponse {
        [$parsed, $options] = TenantListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
        // @phpstan-ignore-next-line;
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
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of accounts to return
     * (defaults to 20, maximum value of 100)
     *
     * @throws APIException
     */
    public function listUsers(
        string $tenantID,
        $cursor = omit,
        $limit = omit,
        ?RequestOptions $requestOptions = null,
    ): TenantListUsersResponse {
        $params = ['cursor' => $cursor, 'limit' => $limit];

        return $this->listUsersRaw($tenantID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listUsersRaw(
        string $tenantID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): TenantListUsersResponse {
        [$parsed, $options] = TenantListUsersParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['tenants/%1$s/users', $tenantID],
            query: $parsed,
            options: $options,
            convert: TenantListUsersResponse::class,
        );
    }
}
