<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TenantsContract;
use Courier\Tenants\TenantAssociation;
use Courier\Users\Tenants\TenantAddMultipleParams;
use Courier\Users\Tenants\TenantAddSingleParams;
use Courier\Users\Tenants\TenantListParams;
use Courier\Users\Tenants\TenantListResponse;
use Courier\Users\Tenants\TenantRemoveSingleParams;

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
     * @param array{cursor?: string|null, limit?: int|null}|TenantListParams $params
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        array|TenantListParams $params,
        ?RequestOptions $requestOptions = null,
    ): TenantListResponse {
        [$parsed, $options] = TenantListParams::parseRequest(
            $params,
            $requestOptions,
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
     * @param array{
     *   tenants: list<array{
     *     tenant_id: string,
     *     profile?: array<string,mixed>|null,
     *     type?: 'user'|null,
     *     user_id?: string|null,
     *   }|TenantAssociation>,
     * }|TenantAddMultipleParams $params
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        array|TenantAddMultipleParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = TenantAddMultipleParams::parseRequest(
            $params,
            $requestOptions,
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
     * @param array{
     *   user_id: string, profile?: array<string,mixed>|null
     * }|TenantAddSingleParams $params
     *
     * @throws APIException
     */
    public function addSingle(
        string $tenantID,
        array|TenantAddSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = TenantAddSingleParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['user_id'];
        unset($parsed['user_id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/tenants/%2$s', $userID, $tenantID],
            body: (object) array_diff_key($parsed, ['user_id']),
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
     * @param array{user_id: string}|TenantRemoveSingleParams $params
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        array|TenantRemoveSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = TenantRemoveSingleParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['user_id'];
        unset($parsed['user_id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['users/%1$s/tenants/%2$s', $userID, $tenantID],
            options: $options,
            convert: null,
        );
    }
}
