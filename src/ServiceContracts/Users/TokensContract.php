<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenListResponse;

interface TokensContract
{
    /**
     * @api
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
    ): TokenGetResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): TokenListResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $token path param: The full token string
     * @param string $userID Path param: The user's ID. This can be any uniquely identifiable string.
     * @param string $token1 Body param: Full body of the token. Must match token in URL path parameter.
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
        string $token,
        string $userID,
        string $token1,
        string|ProviderKey $providerKey,
        ?array $device = null,
        string|bool|null $expiryDate = null,
        mixed $properties = null,
        ?array $tracking = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
