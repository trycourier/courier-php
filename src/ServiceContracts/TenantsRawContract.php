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

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TenantsRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $tenantID a unique identifier representing the tenant to be returned
     * @param array<string,mixed>|TenantUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TenantListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TenantListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TenantListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $tenantID id of the tenant for user membership
     * @param array<string,mixed>|TenantListUsersParams $params
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
    ): BaseResponse;
}
