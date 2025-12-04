<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\ListListParams;
use Courier\Lists\ListListResponse;
use Courier\Lists\ListUpdateParams;
use Courier\Lists\SubscriptionList;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\ServiceContracts\ListsContract;
use Courier\Services\Lists\SubscriptionsService;

final class ListsService implements ListsContract
{
    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->subscriptions = new SubscriptionsService($client);
    }

    /**
     * @api
     *
     * Returns a list based on the list ID provided.
     *
     * @throws APIException
     */
    public function retrieve(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): SubscriptionList {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['lists/%1$s', $listID],
            options: $requestOptions,
            convert: SubscriptionList::class,
        );
    }

    /**
     * @api
     *
     * Create or replace an existing list with the supplied values.
     *
     * @param array{
     *   name: string,
     *   preferences?: array{
     *     categories?: array<string,array<mixed>|NotificationPreferenceDetails>|null,
     *     notifications?: array<string,array<mixed>|NotificationPreferenceDetails>|null,
     *   }|RecipientPreferences|null,
     * }|ListUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $listID,
        array|ListUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = ListUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['lists/%1$s', $listID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns all of the lists, with the ability to filter based on a pattern.
     *
     * @param array{cursor?: string|null, pattern?: string|null}|ListListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|ListListParams $params,
        ?RequestOptions $requestOptions = null
    ): ListListResponse {
        [$parsed, $options] = ListListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'lists',
            query: $parsed,
            options: $options,
            convert: ListListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a list by list ID.
     *
     * @throws APIException
     */
    public function delete(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['lists/%1$s', $listID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Restore a previously deleted list.
     *
     * @throws APIException
     */
    public function restore(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['lists/%1$s/restore', $listID],
            options: $requestOptions,
            convert: null,
        );
    }
}
