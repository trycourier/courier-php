<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TokensContract;
use Courier\Users\Tokens\TokenAddSingleParams;
use Courier\Users\Tokens\TokenDeleteParams;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenListResponse;
use Courier\Users\Tokens\TokenRetrieveParams;
use Courier\Users\Tokens\TokenUpdateParams;

final class TokensService implements TokensContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get single token available for a `:token`
     *
     * @param array{user_id: string}|TokenRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        array|TokenRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): TokenGetResponse {
        [$parsed, $options] = TokenRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['user_id'];
        unset($parsed['user_id']);

        /** @var BaseResponse<TokenGetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            options: $options,
            convert: TokenGetResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Apply a JSON Patch (RFC 6902) to the specified token.
     *
     * @param array{
     *   user_id: string,
     *   patch: list<array{op: string, path: string, value?: string|null}>,
     * }|TokenUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $token,
        array|TokenUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = TokenUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['user_id'];
        unset($parsed['user_id']);

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'patch',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            body: (object) array_diff_key($parsed, ['user_id']),
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Gets all tokens available for a :user_id
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): TokenListResponse {
        /** @var BaseResponse<TokenListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['users/%1$s/tokens', $userID],
            options: $requestOptions,
            convert: TokenListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete User Token
     *
     * @param array{user_id: string}|TokenDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        array|TokenDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = TokenDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['user_id'];
        unset($parsed['user_id']);

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Adds multiple tokens to a user and overwrites matching existing tokens.
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'put',
            path: ['users/%1$s/tokens', $userID],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Adds a single token to a user and overwrites a matching existing token.
     *
     * @param array{
     *   user_id: string,
     *   token: string,
     *   provider_key: 'firebase-fcm'|'apn'|'expo'|'onesignal',
     *   device?: array{
     *     ad_id?: string|null,
     *     app_id?: string|null,
     *     device_id?: string|null,
     *     manufacturer?: string|null,
     *     model?: string|null,
     *     platform?: string|null,
     *   }|null,
     *   expiry_date?: string|bool|null,
     *   properties?: mixed,
     *   tracking?: array{
     *     ip?: string|null,
     *     lat?: string|null,
     *     long?: string|null,
     *     os_version?: string|null,
     *   }|null,
     * }|TokenAddSingleParams $params
     *
     * @throws APIException
     */
    public function addSingle(
        string $token,
        array|TokenAddSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = TokenAddSingleParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['user_id'];
        unset($parsed['user_id']);

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'put',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            body: (object) array_diff_key($parsed, ['user_id']),
            options: $options,
            convert: null,
        );

        return $response->parse();
    }
}
