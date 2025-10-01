<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Profiles;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeParams\List;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface ListsContract
{
    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of message statuses
     *
     * @return ListGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): ListGetResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return ListGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): ListGetResponse;

    /**
     * @api
     *
     * @return ListDeleteResponse<HasRawResponse>
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
     * @return ListDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $userID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): ListDeleteResponse;

    /**
     * @api
     *
     * @param list<List> $lists
     *
     * @return ListSubscribeResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        $lists,
        ?RequestOptions $requestOptions = null
    ): ListSubscribeResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return ListSubscribeResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function subscribeRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): ListSubscribeResponse;
}
