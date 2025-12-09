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
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\ServiceContracts\Profiles\ListsContract;

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
     * @param array{cursor?: string|null}|ListRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|ListRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): ListGetResponse {
        [$parsed, $options] = ListRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<ListGetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['profiles/%1$s/lists', $userID],
            query: $parsed,
            options: $options,
            convert: ListGetResponse::class,
        );

        return $response->parse();
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
        /** @var BaseResponse<ListDeleteResponse> */
        $response = $this->client->request(
            method: 'delete',
            path: ['profiles/%1$s/lists', $userID],
            options: $requestOptions,
            convert: ListDeleteResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes the given user to one or more lists. If the list does not exist, it will be created.
     *
     * @param array{
     *   lists: list<array{
     *     listID: string, preferences?: array<mixed>|RecipientPreferences|null
     *   }>,
     * }|ListSubscribeParams $params
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        array|ListSubscribeParams $params,
        ?RequestOptions $requestOptions = null,
    ): ListSubscribeResponse {
        [$parsed, $options] = ListSubscribeParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<ListSubscribeResponse> */
        $response = $this->client->request(
            method: 'post',
            path: ['profiles/%1$s/lists', $userID],
            body: (object) $parsed,
            options: $options,
            convert: ListSubscribeResponse::class,
        );

        return $response->parse();
    }
}
