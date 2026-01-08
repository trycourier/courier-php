<?php

declare(strict_types=1);

namespace Courier\Services\Profiles;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\Profiles\SubscribeToListsRequestItem;
use Courier\RequestOptions;
use Courier\ServiceContracts\Profiles\ListsContract;

/**
 * @phpstan-import-type SubscribeToListsRequestItemShape from \Courier\Profiles\SubscribeToListsRequestItem
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ListsService implements ListsContract
{
    /**
     * @api
     */
    public ListsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ListsRawService($client);
    }

    /**
     * @api
     *
     * Returns the subscribed lists for a specified user.
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
    ): ListGetResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes all list subscriptions for given user.
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): ListDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($userID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes the given user to one or more lists. If the list does not exist, it will be created.
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
    ): ListSubscribeResponse {
        $params = Util::removeNulls(['lists' => $lists]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->subscribe($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
