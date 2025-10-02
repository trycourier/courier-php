<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\Users\Tokens\TokenAddSingleParams\Device;
use Courier\Users\Tokens\TokenAddSingleParams\ProviderKey;
use Courier\Users\Tokens\TokenAddSingleParams\Tracking;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenUpdateParams\Patch;
use Courier\Users\Tokens\UserToken;

use const Courier\Core\OMIT as omit;

interface TokensContract
{
    /**
     * @api
     *
     * @param string $userID
     *
     * @return TokenGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        $userID,
        ?RequestOptions $requestOptions = null
    ): TokenGetResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return TokenGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $token,
        array $params,
        ?RequestOptions $requestOptions = null
    ): TokenGetResponse;

    /**
     * @api
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
    ): mixed;

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
    ): mixed;

    /**
     * @api
     *
     * @return list<UserToken>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): array;

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
    ): array;

    /**
     * @api
     *
     * @param string $userID
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        $userID,
        ?RequestOptions $requestOptions = null
    ): mixed;

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
    ): mixed;

    /**
     * @api
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
     * @throws APIException
     */
    public function addMultipleRaw(
        string $userID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): mixed;

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
    ): mixed;
}
