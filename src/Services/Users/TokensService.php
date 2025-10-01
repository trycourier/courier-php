<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Conversion\ListOf;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TokensContract;
use Courier\Users\Tokens\TokenAddSingleParams;
use Courier\Users\Tokens\TokenAddSingleParams\Device;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenAddSingleParams\Tracking;
use Courier\Users\Tokens\TokenDeleteParams;
use Courier\Users\Tokens\TokenGetSingleResponse;
use Courier\Users\Tokens\TokenRetrieveSingleParams;
use Courier\Users\Tokens\TokenUpdateParams;
use Courier\Users\Tokens\TokenUpdateParams\Patch;
use Courier\Users\Tokens\UserToken;

use const Courier\Core\OMIT as omit;

final class TokensService implements TokensContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Apply a JSON Patch (RFC 6902) to the specified token.
     *
     * @param string $userID
     * @param list<Patch> $patch
     *
     * @throws APIException
     */
    public function update(
        string $token,
        $userID,
        $patch,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['userID' => $userID, 'patch' => $patch];

        return $this->updateRaw($token, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $token,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = TokenUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line;
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
     * @return list<UserToken>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): array {
        $params = [];

        return $this->listRaw($userID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return list<UserToken>
     *
     * @throws APIException
     */
    public function listRaw(
        string $userID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/tokens', $userID],
            options: $requestOptions,
            convert: new ListOf(UserToken::class),
        );
    }

    /**
     * @api
     *
     * Delete User Token
     *
     * @param string $userID
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['userID' => $userID];

        return $this->deleteRaw($token, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $token,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = TokenDeleteParams::parseRequest(
            $params,
            $requestOptions
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = [];

        return $this->addMultipleRaw($userID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function addMultipleRaw(
        string $userID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
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
     * @param string $userID
     * @param ProviderKey|value-of<ProviderKey> $providerKey
     * @param string|null $token1 Full body of the token. Must match token in URL.
     * @param Device|null $device information about the device the token is associated with
     * @param string|bool|null $expiryDate ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     * @param mixed $properties Properties sent to the provider along with the token
     * @param Tracking|null $tracking information about the device the token is associated with
     *
     * @throws APIException
     */
    public function addSingle(
        string $token,
        $userID,
        $providerKey,
        $token1 = omit,
        $device = omit,
        $expiryDate = omit,
        $properties = omit,
        $tracking = omit,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = [
            'userID' => $userID,
            'providerKey' => $providerKey,
            'token' => $token1,
            'device' => $device,
            'expiryDate' => $expiryDate,
            'properties' => $properties,
            'tracking' => $tracking,
        ];

        return $this->addSingleRaw($token, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function addSingleRaw(
        string $token,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = TokenAddSingleParams::parseRequest(
            $params,
            $requestOptions
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            body: (object) array_diff_key($parsed, array_flip(['userID'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get single token available for a `:token`
     *
     * @param string $userID
     *
     * @return TokenGetSingleResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveSingle(
        string $token,
        $userID,
        ?RequestOptions $requestOptions = null
    ): TokenGetSingleResponse {
        $params = ['userID' => $userID];

        return $this->retrieveSingleRaw($token, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return TokenGetSingleResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveSingleRaw(
        string $token,
        array $params,
        ?RequestOptions $requestOptions = null
    ): TokenGetSingleResponse {
        [$parsed, $options] = TokenRetrieveSingleParams::parseRequest(
            $params,
            $requestOptions
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/tokens/%2$s', $userID, $token],
            options: $options,
            convert: TokenGetSingleResponse::class,
        );
    }
}
