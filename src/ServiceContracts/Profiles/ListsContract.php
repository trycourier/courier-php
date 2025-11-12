<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Profiles;

use Courier\Core\Exceptions\APIException;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListRetrieveParams;
use Courier\Profiles\Lists\ListSubscribeParams;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\RequestOptions;

interface ListsContract
{
    /**
     * @api
     *
     * @param array<mixed>|ListRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|ListRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): ListGetResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): ListDeleteResponse;

    /**
     * @api
     *
     * @param array<mixed>|ListSubscribeParams $params
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        array|ListSubscribeParams $params,
        ?RequestOptions $requestOptions = null,
    ): ListSubscribeResponse;
}
