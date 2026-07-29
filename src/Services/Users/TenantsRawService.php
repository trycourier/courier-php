<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TenantsRawContract;
use Courier\Tenants\TenantAssociation;
use Courier\Users\Tenants\TenantAddMultipleParams;
use Courier\Users\Tenants\TenantAddSingleParams;
use Courier\Users\Tenants\TenantListParams;
use Courier\Users\Tenants\TenantListResponse;
use Courier\Users\Tenants\TenantRemoveSingleParams;

/**
 * Associate a user with one or more tenants, and read or remove those associations.
 *
 * @phpstan-import-type TenantAssociationShape from \Courier\Tenants\TenantAssociation
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
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
     * Returns the tenants a user belongs to, with cursor paging. A user can belong to many tenants, each with its own profile and preferences.
     *
     * @param string $userID id of the user to retrieve all associated tenants for
     * @param array{cursor?: string|null, limit?: int|null}|TenantListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TenantListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        array|TenantListParams $params,
        RequestOptions|array|null $requestOptions = null,
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
     * Adds a user to several tenants in one call, each optionally with a per-tenant profile that overrides their workspace profile.
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param array{
     *   tenants: list<TenantAssociation|TenantAssociationShape>
     * }|TenantAddMultipleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        array|TenantAddMultipleParams $params,
        RequestOptions|array|null $requestOptions = null,
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
     * Adds a user to one tenant, optionally with a tenant-specific profile that overrides their workspace profile for sends in that tenant.
     *
     * @param string $tenantID path param: Id of the tenant the user should be added to
     * @param array{
     *   userID: string, profile?: array<string,mixed>|null
     * }|TenantAddSingleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addSingle(
        string $tenantID,
        array|TenantAddSingleParams $params,
        RequestOptions|array|null $requestOptions = null,
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
            body: (object) array_diff_key($parsed, array_flip(['userID'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Removes a user from every tenant they belong to in one call. Their workspace-level profile is a separate resource.
     *
     * @param string $userID id of the user to be removed from the supplied tenant
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function removeAll(
        string $userID,
        RequestOptions|array|null $requestOptions = null
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
     * Removes a user from one tenant. Their other tenant memberships and workspace profile are managed through separate endpoints.
     *
     * @param string $tenantID id of the tenant the user should be removed from
     * @param array{userID: string}|TenantRemoveSingleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function removeSingle(
        string $tenantID,
        array|TenantRemoveSingleParams $params,
        RequestOptions|array|null $requestOptions = null,
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
