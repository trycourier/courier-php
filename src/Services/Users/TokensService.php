<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\TokensContract;
use Courier\Users\Tokens\TokenAddSingleParams\Device;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenAddSingleParams\Tracking;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenListResponse;
use Courier\Users\Tokens\TokenUpdateParams\Patch;

/**
 * @phpstan-import-type PatchShape from \Courier\Users\Tokens\TokenUpdateParams\Patch
 * @phpstan-import-type DeviceShape from \Courier\Users\Tokens\TokenAddSingleParams\Device
 * @phpstan-import-type ExpiryDateShape from \Courier\Users\Tokens\TokenAddSingleParams\ExpiryDate
 * @phpstan-import-type TrackingShape from \Courier\Users\Tokens\TokenAddSingleParams\Tracking
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        string $userID,
        RequestOptions|array|null $requestOptions = null,
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
     * @param list<Patch|PatchShape> $patch Body param:
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $token,
        string $userID,
        array $patch,
        RequestOptions|array|null $requestOptions = null,
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        RequestOptions|array|null $requestOptions = null
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        string $userID,
        RequestOptions|array|null $requestOptions = null,
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        RequestOptions|array|null $requestOptions = null
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
     * @param ProviderKey|value-of<ProviderKey> $providerKey Body param:
     * @param Device|DeviceShape|null $device body param: Information about the device the token came from
     * @param ExpiryDateShape|null $expiryDate Body param: ISO 8601 formatted date the token expires. Defaults to 2 months. Set to false to disable expiration.
     * @param mixed $properties body param: Properties about the token
     * @param Tracking|TrackingShape|null $tracking body param: Tracking information about the device the token came from
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addSingle(
        string $token_,
        string $userID,
        string $token,
        ProviderKey|string $providerKey,
        Device|array|null $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        Tracking|array|null $tracking = null,
        RequestOptions|array|null $requestOptions = null,
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
