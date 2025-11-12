<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Users\Tokens\TokenAddSingleParams;
use Courier\Users\Tokens\TokenDeleteParams;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenRetrieveParams;
use Courier\Users\Tokens\TokenUpdateParams;
use Courier\Users\Tokens\UserToken;

interface TokensContract
{
    /**
     * @api
     *
     * @param array<mixed>|TokenRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        array|TokenRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): TokenGetResponse;

    /**
     * @api
     *
     * @param array<mixed>|TokenUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $token,
        array|TokenUpdateParams $params,
        ?RequestOptions $requestOptions = null,
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
     * @param array<mixed>|TokenDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        array|TokenDeleteParams $params,
        ?RequestOptions $requestOptions = null,
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
     * @param array<mixed>|TokenAddSingleParams $params
     *
     * @throws APIException
     */
    public function addSingle(
        string $token,
        array|TokenAddSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
