<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TenantsContract;
use Courier\Tenants\TenantAssociation;
use Courier\Tenants\TenantAssociation\Type;
use Courier\Users\Tenants\TenantListResponse;

final class TenantsService implements TenantsContract
{
    /**
     * @api
     */
    public TenantsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TenantsRawService($client);
    }

    /**
     * @api
     *
     * Returns a paginated list of user tenant associations.
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
    ): TenantListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This endpoint is used to add a user to
     * multiple tenants in one call.
     * A custom profile can also be supplied for each tenant.
     * This profile will be merged with the user's main
     * profile when sending to the user with that tenant.
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
    ): mixed {
        $params = Util::removeNulls(['tenants' => $tenants]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->addMultiple($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This endpoint is used to add a single tenant.
     *
     * A custom profile can also be supplied with the tenant.
     * This profile will be merged with the user's main profile
     * when sending to the user with that tenant.
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
    ): mixed {
        $params = Util::removeNulls(['userID' => $userID, 'profile' => $profile]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->addSingle($tenantID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes a user from any tenants they may have been associated with.
     *
     * @param string $userID id of the user to be removed from the supplied tenant
     *
     * @throws APIException
     */
    public function removeAll(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->removeAll($userID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes a user from the supplied tenant.
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
    ): mixed {
        $params = Util::removeNulls(['userID' => $userID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->removeSingle($tenantID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
