<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TenantsRawContract;
use Courier\Tenants\TenantAssociation;
use Courier\Tenants\TenantAssociation\Type;
use Courier\Users\Tenants\TenantAddMultipleParams;
use Courier\Users\Tenants\TenantAddSingleParams;
use Courier\Users\Tenants\TenantListParams;
use Courier\Users\Tenants\TenantListResponse;
use Courier\Users\Tenants\TenantRemoveSingleParams;

final class TenantsRawService implements TenantsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns a paginated list of user tenant associations.
     *
     * @param string $userID id of the user to retrieve all associated tenants for
     * @param array{cursor?: string|null, limit?: int|null}|TenantListParams $params
     *
     * @return BaseResponse<TenantListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        array|TenantListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TenantListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param array{
     *   tenants: list<array{
     *     tenantID: string,
     *     profile?: array<string,mixed>|null,
     *     type?: 'user'|Type|null,
     *     userID?: string|null,
     *   }|TenantAssociation>,
     * }|TenantAddMultipleParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        array|TenantAddMultipleParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TenantAddMultipleParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @param string $tenantID path param: Id of the tenant the user should be added to
     * @param array{
     *   userID: string, profile?: array<string,mixed>|null
     * }|TenantAddSingleParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addSingle(
        string $tenantID,
        array|TenantAddSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TenantAddSingleParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
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
     * @param string $userID id of the user to be removed from the supplied tenant
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function removeAll(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
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
     * @param string $tenantID id of the tenant the user should be removed from
     * @param array{userID: string}|TenantRemoveSingleParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        array|TenantRemoveSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TenantRemoveSingleParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['users/%1$s/tenants/%2$s', $userID, $tenantID],
            options: $options,
            convert: null,
        );
    }
}
