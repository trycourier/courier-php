<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Profiles;

use Courier\Core\Exceptions\APIException;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\Profiles\SubscribeToListsRequestItem;
use Courier\RequestOptions;

/**
 * @phpstan-import-type SubscribeToListsRequestItemShape from \Courier\Profiles\SubscribeToListsRequestItem
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface ListsContract
{
    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param string|null $cursor a unique identifier that allows for fetching the next set of message statuses
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null,
    ): ListGetResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): ListDeleteResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param list<SubscribeToListsRequestItem|SubscribeToListsRequestItemShape> $lists
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        array $lists,
        RequestOptions|array|null $requestOptions = null,
    ): ListSubscribeResponse;
}
