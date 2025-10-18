<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\DefaultPreferences;
use Courier\Tenants\Tenant;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersResponse;

use const Courier\Core\OMIT as omit;

interface TenantsContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): Tenant;

    /**
     * @api
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
    ): Tenant;

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
    ): Tenant;

    /**
     * @api
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
    ): TenantListResponse;

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
    ): TenantListResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): TenantListUsersResponse;

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
    ): TenantListUsersResponse;
}
