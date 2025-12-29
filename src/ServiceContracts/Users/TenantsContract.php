<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\TenantAssociation;
use Courier\Tenants\TenantAssociation\Type;
use Courier\Users\Tenants\TenantListResponse;

interface TenantsContract
{
    /**
     * @api
     *
     * @param string $userID id of the user to retrieve all associated tenants for
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of accounts to return
     * (defaults to 20, maximum value of 100)
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        ?string $cursor = null,
        ?int $limit = null,
        ?RequestOptions $requestOptions = null,
    ): TenantListResponse;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param list<array{
     *   tenantID: string,
     *   profile?: array<string,mixed>|null,
     *   type?: 'user'|Type|null,
     *   userID?: string|null,
     * }|TenantAssociation> $tenants
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        array $tenants,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $tenantID path param: Id of the tenant the user should be added to
     * @param string $userID path param: Id of the user to be added to the supplied tenant
     * @param array<string,mixed>|null $profile Body param:
     *
     * @throws APIException
     */
    public function addSingle(
        string $tenantID,
        string $userID,
        ?array $profile = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $userID id of the user to be removed from the supplied tenant
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
     * @param string $tenantID id of the tenant the user should be removed from
     * @param string $userID id of the user to be removed from the supplied tenant
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
