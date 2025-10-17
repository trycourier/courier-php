<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Profiles;

use Courier\Core\Exceptions\APIException;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\Profiles\SubscribeToListsRequestItem;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface ListsContract
{
    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of message statuses
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
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): ListDeleteResponse;

    /**
     * @api
     *
     * @param list<SubscribeToListsRequestItem> $lists
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
     * @throws APIException
     */
    public function subscribeRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): ListSubscribeResponse;
}
