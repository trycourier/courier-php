<?php

declare(strict_types=1);

namespace Courier\Services\Lists;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\Subscriptions\SubscriptionAddParams;
use Courier\Lists\Subscriptions\SubscriptionListParams;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\Lists\Subscriptions\SubscriptionSubscribeParams;
use Courier\Lists\Subscriptions\SubscriptionSubscribeUserParams;
use Courier\Lists\Subscriptions\SubscriptionUnsubscribeUserParams;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\ServiceContracts\Lists\SubscriptionsContract;

final class SubscriptionsService implements SubscriptionsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the list's subscriptions.
     *
     * @param array{cursor?: string|null}|SubscriptionListParams $params
     *
     * @throws APIException
     */
    public function list(
        string $listID,
        array|SubscriptionListParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionListResponse {
        [$parsed, $options] = SubscriptionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['lists/%1$s/subscriptions', $listID],
            query: $parsed,
            options: $options,
            convert: SubscriptionListResponse::class,
        );
    }

    /**
     * @api
     *
     * Subscribes additional users to the list, without modifying existing subscriptions. If the list does not exist, it will be automatically created.
     *
     * @param array{
     *   recipients: list<array{
     *     recipientId: string, preferences?: array<mixed>|RecipientPreferences|null
     *   }>,
     * }|SubscriptionAddParams $params
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        array|SubscriptionAddParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SubscriptionAddParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['lists/%1$s/subscriptions', $listID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Subscribes the users to the list, overwriting existing subscriptions. If the list does not exist, it will be automatically created.
     *
     * @param array{
     *   recipients: list<array{
     *     recipientId: string, preferences?: array<mixed>|RecipientPreferences|null
     *   }>,
     * }|SubscriptionSubscribeParams $params
     *
     * @throws APIException
     */
    public function subscribe(
        string $listID,
        array|SubscriptionSubscribeParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SubscriptionSubscribeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['lists/%1$s/subscriptions', $listID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).
     *
     * @param array{
     *   list_id: string,
     *   preferences?: array{
     *     categories?: array<string,array<mixed>|NotificationPreferenceDetails>|null,
     *     notifications?: array<string,array<mixed>|NotificationPreferenceDetails>|null,
     *   }|RecipientPreferences|null,
     * }|SubscriptionSubscribeUserParams $params
     *
     * @throws APIException
     */
    public function subscribeUser(
        string $userID,
        array|SubscriptionSubscribeUserParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SubscriptionSubscribeUserParams::parseRequest(
            $params,
            $requestOptions,
        );
        $listID = $parsed['list_id'];
        unset($parsed['list_id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['lists/%1$s/subscriptions/%2$s', $listID, $userID],
            body: (object) array_diff_key($parsed, ['list_id']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Delete a subscription to a list by list ID and user ID.
     *
     * @param array{list_id: string}|SubscriptionUnsubscribeUserParams $params
     *
     * @throws APIException
     */
    public function unsubscribeUser(
        string $userID,
        array|SubscriptionUnsubscribeUserParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SubscriptionUnsubscribeUserParams::parseRequest(
            $params,
            $requestOptions,
        );
        $listID = $parsed['list_id'];
        unset($parsed['list_id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['lists/%1$s/subscriptions/%2$s', $listID, $userID],
            options: $options,
            convert: null,
        );
    }
}
