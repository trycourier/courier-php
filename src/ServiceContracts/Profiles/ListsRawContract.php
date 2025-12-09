<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Profiles;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListRetrieveParams;
use Courier\Profiles\Lists\ListSubscribeParams;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\RequestOptions;

interface ListsRawContract
{
    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array<mixed>|ListRetrieveParams $params
     *
     * @return BaseResponse<ListGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|ListRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     *
     * @return BaseResponse<ListDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array<mixed>|ListSubscribeParams $params
     *
     * @return BaseResponse<ListSubscribeResponse>
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        array|ListSubscribeParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
