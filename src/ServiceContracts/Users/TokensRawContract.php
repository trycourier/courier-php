<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Users\Tokens\TokenAddSingleParams;
use Courier\Users\Tokens\TokenDeleteParams;
use Courier\Users\Tokens\TokenGetResponse;
use Courier\Users\Tokens\TokenListResponse;
use Courier\Users\Tokens\TokenRetrieveParams;
use Courier\Users\Tokens\TokenUpdateParams;

interface TokensRawContract
{
    /**
     * @api
     *
     * @param string $token the full token string
     * @param array<mixed>|TokenRetrieveParams $params
     *
     * @return BaseResponse<TokenGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        array|TokenRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $token path param: The full token string
     * @param array<mixed>|TokenUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $token,
        array|TokenUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $token the full token string
     * @param array<mixed>|TokenDeleteParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        array|TokenDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $token_ path param: The full token string
     * @param array<mixed>|TokenAddSingleParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addSingle(
        string $token_,
        array|TokenAddSingleParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
