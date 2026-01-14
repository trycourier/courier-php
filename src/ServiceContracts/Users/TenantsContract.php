<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\TenantAssociation;
use Courier\Users\Tenants\TenantListResponse;

/**
 * @phpstan-import-type TenantAssociationShape from \Courier\Tenants\TenantAssociation
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TenantsContract
{
    /**
     * @api
     *
     * @param string $userID id of the user to retrieve all associated tenants for
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of accounts to return
     * (defaults to 20, maximum value of 100)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): TenantListResponse;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param list<TenantAssociation|TenantAssociationShape> $tenants
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        array $tenants,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $tenantID path param: Id of the tenant the user should be added to
     * @param string $userID path param: Id of the user to be added to the supplied tenant
     * @param array<string,mixed>|null $profile Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addSingle(
        string $tenantID,
        string $userID,
        ?array $profile = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $userID id of the user to be removed from the supplied tenant
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function removeAll(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $tenantID id of the tenant the user should be removed from
     * @param string $userID id of the user to be removed from the supplied tenant
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        string $userID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
