<?php

declare(strict_types=1);

namespace Courier\Services\Profiles;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListRetrieveParams;
use Courier\Profiles\Lists\ListSubscribeParams;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\Profiles\SubscribeToListsRequestItem;
use Courier\RequestOptions;
use Courier\ServiceContracts\Profiles\ListsRawContract;

/**
 * @phpstan-import-type SubscribeToListsRequestItemShape from \Courier\Profiles\SubscribeToListsRequestItem
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ListsRawService implements ListsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the subscribed lists for a specified user.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array{cursor?: string|null}|ListRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ListGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|ListRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ListRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ListDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
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
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array{
     *   lists: list<SubscribeToListsRequestItem|SubscribeToListsRequestItemShape>
     * }|ListSubscribeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ListSubscribeResponse>
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        array|ListSubscribeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ListSubscribeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['profiles/%1$s/lists', $userID],
            body: (object) $parsed,
            options: $options,
            convert: ListSubscribeResponse::class,
        );
    }
}
