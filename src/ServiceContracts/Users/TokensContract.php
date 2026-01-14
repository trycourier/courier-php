<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
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
interface TokensContract
{
    /**
     * @api
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
    ): TokenGetResponse;

    /**
     * @api
     *
     * @param string $token path param: The full token string
     * @param string $userID Path param: The user's ID. This can be any uniquely identifiable string.
     * @param list<Patch|PatchShape> $patch Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $token,
        string $userID,
        array $patch,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): TokenListResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $token_ path param: The full token string
     * @param string $userID Path param: The user's ID. This can be any uniquely identifiable string.
     * @param string $token Body param: Full body of the token. Must match token in URL path parameter.
     * @param ProviderKey|value-of<ProviderKey> $providerKey Body param
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
    ): mixed;
}
