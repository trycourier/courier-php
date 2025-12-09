<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\Tenant;
use Courier\Tenants\TenantListParams;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersParams;
use Courier\Tenants\TenantListUsersResponse;
use Courier\Tenants\TenantUpdateParams;

interface TenantsRawContract
{
    /**
     * @api
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     *
     * @return BaseResponse<Tenant>
     *
     * @throws APIException
     */
    public function retrieve(
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     * @param array<mixed>|TenantUpdateParams $params
     *
     * @return BaseResponse<Tenant>
     *
     * @throws APIException
     */
    public function update(
        string $tenantID,
        array|TenantUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|TenantListParams $params
     *
     * @return BaseResponse<TenantListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TenantListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $tenantID id of the tenant to be deleted
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $tenantID id of the tenant for user membership
     * @param array<mixed>|TenantListUsersParams $params
     *
     * @return BaseResponse<TenantListUsersResponse>
     *
     * @throws APIException
     */
    public function listUsers(
        string $tenantID,
        array|TenantListUsersParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
