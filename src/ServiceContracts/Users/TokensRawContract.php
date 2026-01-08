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

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TokensRawContract
{
    /**
     * @api
     *
     * @param string $token the full token string
     * @param array<string,mixed>|TokenRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TokenGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $token,
        array|TokenRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $token path param: The full token string
     * @param array<string,mixed>|TokenUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $token,
        array|TokenUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TokenListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $token the full token string
     * @param array<string,mixed>|TokenDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $token,
        array|TokenDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $userID The user's ID. This can be any uniquely identifiable string.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addMultiple(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $token_ path param: The full token string
     * @param array<string,mixed>|TokenAddSingleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function addSingle(
        string $token_,
        array|TokenAddSingleParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
