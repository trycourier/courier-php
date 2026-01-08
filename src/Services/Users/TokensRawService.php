<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TokensRawContract;
use Courier\Users\Tokens\TokenAddSingleParams;
use Courier\Users\Tokens\TokenAddSingleParams\Device;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenAddSingleParams\Tracking;
use Courier\Users\Tokens\TokenDeleteParams;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenListResponse;
use Courier\Users\Tokens\TokenRetrieveParams;
use Courier\Users\Tokens\TokenUpdateParams;
use Courier\Users\Tokens\TokenUpdateParams\Patch;

/**
 * @phpstan-import-type PatchShape from \Courier\Users\Tokens\TokenUpdateParams\Patch
 * @phpstan-import-type DeviceShape from \Courier\Users\Tokens\TokenAddSingleParams\Device
 * @phpstan-import-type ExpiryDateShape from \Courier\Users\Tokens\TokenAddSingleParams\ExpiryDate
 * @phpstan-import-type TrackingShape from \Courier\Users\Tokens\TokenAddSingleParams\Tracking
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TokensRawService implements TokensRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get single token available for a `:token`
     *
     * @param string $token the full token string
     * @param array{userID: string}|TokenRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TokenGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        array|TokenRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TokenRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            options: $options,
            convert: TokenGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Apply a JSON Patch (RFC 6902) to the specified token.
     *
     * @param string $token path param: The full token string
     * @param array{
     *   userID: string, patch: list<Patch|PatchShape>
     * }|TokenUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $token,
        array|TokenUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TokenUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            body: (object) array_diff_key($parsed, array_flip(['userID'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Gets all tokens available for a :user_id
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TokenListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/tokens', $userID],
            options: $requestOptions,
            convert: TokenListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete User Token
     *
     * @param string $token the full token string
     * @param array{userID: string}|TokenDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        array|TokenDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TokenDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Adds multiple tokens to a user and overwrites matching existing tokens.
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/tokens', $userID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Adds a single token to a user and overwrites a matching existing token.
     *
     * @param string $token_ path param: The full token string
     * @param array{
     *   userID: string,
     *   token: string,
     *   providerKey: ProviderKey|value-of<ProviderKey>,
     *   device?: Device|DeviceShape|null,
     *   expiryDate?: ExpiryDateShape|null,
     *   properties?: mixed,
     *   tracking?: Tracking|TrackingShape|null,
     * }|TokenAddSingleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addSingle(
        string $token_,
        array|TokenAddSingleParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TokenAddSingleParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/tokens/%2$s', $userID, $token_],
            body: (object) array_diff_key($parsed, array_flip(['userID'])),
            options: $options,
            convert: null,
        );
    }
}
