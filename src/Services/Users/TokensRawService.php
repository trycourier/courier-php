<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TokensRawContract;
use Courier\Users\Tokens\TokenAddSingleParams;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenDeleteParams;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenListResponse;
use Courier\Users\Tokens\TokenRetrieveParams;
use Courier\Users\Tokens\TokenUpdateParams;

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
     *
     * @return BaseResponse<TokenGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        array|TokenRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
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
     *   userID: string,
     *   patch: list<array{op: string, path: string, value?: string|null}>,
     * }|TokenUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $token,
        array|TokenUpdateParams $params,
        ?RequestOptions $requestOptions = null,
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
            body: (object) array_diff_key($parsed, ['userID']),
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
     *
     * @return BaseResponse<TokenListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        ?RequestOptions $requestOptions = null
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
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        array|TokenDeleteParams $params,
        ?RequestOptions $requestOptions = null,
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
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        ?RequestOptions $requestOptions = null
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
     *   providerKey: 'firebase-fcm'|'apn'|'expo'|'onesignal'|ProviderKey,
     *   device?: array{
     *     adID?: string|null,
     *     appID?: string|null,
     *     deviceID?: string|null,
     *     manufacturer?: string|null,
     *     model?: string|null,
     *     platform?: string|null,
     *   }|null,
     *   expiryDate?: string|bool|null,
     *   properties?: mixed,
     *   tracking?: array{
     *     ip?: string|null,
     *     lat?: string|null,
     *     long?: string|null,
     *     osVersion?: string|null,
     *   }|null,
     * }|TokenAddSingleParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addSingle(
        string $token_,
        array|TokenAddSingleParams $params,
        ?RequestOptions $requestOptions = null,
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
            body: (object) array_diff_key($parsed, ['userID']),
            options: $options,
            convert: null,
        );
    }
}
