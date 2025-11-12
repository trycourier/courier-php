<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Users\Tenants\TenantAddMultipleParams;
use Courier\Users\Tenants\TenantAddSingleParams;
use Courier\Users\Tenants\TenantListParams;
use Courier\Users\Tenants\TenantListResponse;
use Courier\Users\Tenants\TenantRemoveSingleParams;

interface TenantsContract
{
    /**
     * @api
     *
     * @param array<mixed>|TenantListParams $params
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        array|TenantListParams $params,
        ?RequestOptions $requestOptions = null,
    ): TenantListResponse;

    /**
     * @api
     *
     * @param array<mixed>|TenantAddMultipleParams $params
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        array|TenantAddMultipleParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|TenantAddSingleParams $params
     *
     * @throws APIException
     */
    public function addSingle(
        string $tenantID,
        array|TenantAddSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function removeAll(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|TenantRemoveSingleParams $params
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        array|TenantRemoveSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
