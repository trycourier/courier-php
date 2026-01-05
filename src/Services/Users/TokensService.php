<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TokensContract;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenListResponse;

final class TokensService implements TokensContract
{
    /**
     * @api
     */
    public TokensRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TokensRawService($client);
    }

    /**
     * @api
     *
     * Get single token available for a `:token`
     *
     * @param string $token the full token string
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        string $userID,
        ?RequestOptions $requestOptions = null
    ): TokenGetResponse {
        $params = Util::removeNulls(['userID' => $userID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($token, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Apply a JSON Patch (RFC 6902) to the specified token.
     *
     * @param string $token path param: The full token string
     * @param string $userID Path param: The user's ID. This can be any uniquely identifiable string.
     * @param list<array{
     *   op: string, path: string, value?: string|null
     * }> $patch Body param:
     *
     * @throws APIException
     */
    public function update(
        string $token,
        string $userID,
        array $patch,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['userID' => $userID, 'patch' => $patch]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($token, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Gets all tokens available for a :user_id
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): TokenListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($userID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete User Token
     *
     * @param string $token the full token string
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['userID' => $userID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($token, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Adds multiple tokens to a user and overwrites matching existing tokens.
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->addMultiple($userID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Adds a single token to a user and overwrites a matching existing token.
     *
     * @param string $token_ path param: The full token string
     * @param string $userID Path param: The user's ID. This can be any uniquely identifiable string.
     * @param string $token Body param: Full body of the token. Must match token in URL path parameter.
     * @param 'firebase-fcm'|'apn'|'expo'|'onesignal'|ProviderKey $providerKey Body param:
     * @param array{
     *   adID?: string|null,
     *   appID?: string|null,
     *   deviceID?: string|null,
     *   manufacturer?: string|null,
     *   model?: string|null,
     *   platform?: string|null,
     * }|null $device Body param: Information about the device the token came from
     * @param string|bool|null $expiryDate Body param: ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     * @param mixed $properties body param: Properties about the token
     * @param array{
     *   ip?: string|null,
     *   lat?: string|null,
     *   long?: string|null,
     *   osVersion?: string|null,
     * }|null $tracking Body param: Tracking information about the device the token came from
     *
     * @throws APIException
     */
    public function addSingle(
        string $token_,
        string $userID,
        string $token,
        string|ProviderKey $providerKey,
        ?array $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        ?array $tracking = null,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'userID' => $userID,
                'token' => $token,
                'providerKey' => $providerKey,
                'device' => $device,
                'expiryDate' => $expiryDate,
                'properties' => $properties,
                'tracking' => $tracking,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->addSingle($token_, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
