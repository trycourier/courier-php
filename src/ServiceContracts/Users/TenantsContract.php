<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\TenantAssociation;
use Courier\Users\Tenants\TenantListResponse;

use const Courier\Core\OMIT as omit;

interface TenantsContract
{
    /**
     * @api
     *
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of accounts to return
     * (defaults to 20, maximum value of 100)
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        $cursor = omit,
        $limit = omit,
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
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): TenantListResponse;

    /**
     * @api
     *
     * @param list<TenantAssociation> $tenants
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        $tenants,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function addMultipleRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $userID
     * @param array<string, mixed>|null $profile
     *
     * @throws APIException
     */
    public function addSingle(
        string $tenantID,
        $userID,
        $profile = omit,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function addSingleRaw(
        string $tenantID,
        array $params,
        ?RequestOptions $requestOptions = null
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
     * @param string $userID
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        $userID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function removeSingleRaw(
        string $tenantID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
