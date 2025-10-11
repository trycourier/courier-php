<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TenantsContract;
use Courier\TenantAssociation;
use Courier\Users\Tenants\TenantAddMultipleParams;
use Courier\Users\Tenants\TenantAddSingleParams;
use Courier\Users\Tenants\TenantListParams;
use Courier\Users\Tenants\TenantListResponse;
use Courier\Users\Tenants\TenantRemoveSingleParams;

use const Courier\Core\OMIT as omit;

final class TenantsService implements TenantsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns a paginated list of user tenant associations.
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
    ): TenantListResponse {
        $params = ['cursor' => $cursor, 'limit' => $limit];

        return $this->listRaw($userID, $params, $requestOptions);
    }

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
    ): TenantListResponse {
        [$parsed, $options] = TenantListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/tenants', $userID],
            query: $parsed,
            options: $options,
            convert: TenantListResponse::class,
        );
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
     * @param list<TenantAssociation> $tenants
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        $tenants,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['tenants' => $tenants];

        return $this->addMultipleRaw($userID, $params, $requestOptions);
    }

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
    ): mixed {
        [$parsed, $options] = TenantAddMultipleParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/tenants', $userID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
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
    ): mixed {
        $params = ['userID' => $userID, 'profile' => $profile];

        return $this->addSingleRaw($tenantID, $params, $requestOptions);
    }

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
    ): mixed {
        [$parsed, $options] = TenantAddSingleParams::parseRequest(
            $params,
            $requestOptions
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/tenants/%2$s', $userID, $tenantID],
            body: (object) array_diff_key($parsed, ['userID']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Removes a user from any tenants they may have been associated with.
     *
     * @throws APIException
     */
    public function removeAll(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['users/%1$s/tenants', $userID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Removes a user from the supplied tenant.
     *
     * @param string $userID
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['userID' => $userID];

        return $this->removeSingleRaw($tenantID, $params, $requestOptions);
    }

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
    ): mixed {
        [$parsed, $options] = TenantRemoveSingleParams::parseRequest(
            $params,
            $requestOptions
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['users/%1$s/tenants/%2$s', $userID, $tenantID],
            options: $options,
            convert: null,
        );
    }
}
