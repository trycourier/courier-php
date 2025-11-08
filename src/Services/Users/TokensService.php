<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Conversion\ListOf;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TokensContract;
use Courier\Users\Tokens\TokenAddSingleParams;
use Courier\Users\Tokens\TokenAddSingleParams\Device;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenAddSingleParams\Tracking;
use Courier\Users\Tokens\TokenDeleteParams;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenRetrieveParams;
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
     * Get single token available for a `:token`
     *
     * @param string $userID
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        $userID,
        ?RequestOptions $requestOptions = null
    ): TokenGetResponse {
        $params = ['userID' => $userID];

        return $this->retrieveRaw($token, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $token,
        array $params,
        ?RequestOptions $requestOptions = null
    ): TokenGetResponse {
        [$parsed, $options] = TokenRetrieveParams::parseRequest(
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
            convert: TokenGetResponse::class,
        );
    }

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
     * @return list<UserToken>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
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
     * @param string $token1 Full body of the token. Must match token in URL path parameter.
     * @param ProviderKey|value-of<ProviderKey> $providerKey
     * @param Device|null $device information about the device the token came from
     * @param string|bool|null $expiryDate ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     * @param mixed $properties properties about the token
     * @param Tracking|null $tracking tracking information about the device the token came from
     *
     * @throws APIException
     */
    public function addSingle(
        string $token,
        $userID,
        $token1,
        $providerKey,
        $device = omit,
        $expiryDate = omit,
        $properties = omit,
        $tracking = omit,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = [
            'userID' => $userID,
            'token' => $token1,
            'providerKey' => $providerKey,
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
            body: (object) array_diff_key($parsed, ['userID']),
            options: $options,
            convert: null,
        );
    }
}
