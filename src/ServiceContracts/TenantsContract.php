<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\Tenant;
use Courier\Tenants\TenantListParams;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersParams;
use Courier\Tenants\TenantListUsersResponse;
use Courier\Tenants\TenantUpdateParams;

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
     * @param array<mixed>|TenantUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $tenantID,
        array|TenantUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Tenant;

    /**
     * @api
     *
     * @param array<mixed>|TenantListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|TenantListParams $params,
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
     * @param array<mixed>|TenantListUsersParams $params
     *
     * @throws APIException
     */
    public function listUsers(
        string $tenantID,
        array|TenantListUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): TenantListUsersResponse;
}
