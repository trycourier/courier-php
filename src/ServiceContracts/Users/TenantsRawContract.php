<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Users\Tenants\TenantAddMultipleParams;
use Courier\Users\Tenants\TenantAddSingleParams;
use Courier\Users\Tenants\TenantListParams;
use Courier\Users\Tenants\TenantListResponse;
use Courier\Users\Tenants\TenantRemoveSingleParams;

interface TenantsRawContract
{
    /**
     * @api
     *
     * @param string $userID id of the user to retrieve all associated tenants for
     * @param array<mixed>|TenantListParams $params
     *
     * @return BaseResponse<TenantListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        array|TenantListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param array<mixed>|TenantAddMultipleParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        array|TenantAddMultipleParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $tenantID path param: Id of the tenant the user should be added to
     * @param array<mixed>|TenantAddSingleParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addSingle(
        string $tenantID,
        array|TenantAddSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $userID id of the user to be removed from the supplied tenant
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function removeAll(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $tenantID id of the tenant the user should be removed from
     * @param array<mixed>|TenantRemoveSingleParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        array|TenantRemoveSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
