<?php

declare(strict_types=1);

namespace Courier\Services\Profiles;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListRetrieveParams;
use Courier\Profiles\Lists\ListSubscribeParams;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\Profiles\SubscribeToListsRequestItem;
use Courier\RequestOptions;
use Courier\ServiceContracts\Profiles\ListsContract;

use const Courier\Core\OMIT as omit;

final class ListsService implements ListsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the subscribed lists for a specified user.
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of message statuses
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): ListGetResponse {
        $params = ['cursor' => $cursor];

        return $this->retrieveRaw($userID, $params, $requestOptions);
    }

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
    ): ListGetResponse {
        [$parsed, $options] = ListRetrieveParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['profiles/%1$s/lists', $userID],
            query: $parsed,
            options: $options,
            convert: ListGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Removes all list subscriptions for given user.
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): ListDeleteResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['profiles/%1$s/lists', $userID],
            options: $requestOptions,
            convert: ListDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Subscribes the given user to one or more lists. If the list does not exist, it will be created.
     *
     * @param list<SubscribeToListsRequestItem> $lists
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        $lists,
        ?RequestOptions $requestOptions = null
    ): ListSubscribeResponse {
        $params = ['lists' => $lists];

        return $this->subscribeRaw($userID, $params, $requestOptions);
    }

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
    ): ListSubscribeResponse {
        [$parsed, $options] = ListSubscribeParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['profiles/%1$s/lists', $userID],
            body: (object) $parsed,
            options: $options,
            convert: ListSubscribeResponse::class,
        );
    }
}
