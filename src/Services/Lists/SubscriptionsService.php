<?php

declare(strict_types=1);

namespace Courier\Services\Lists;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\Lists\Subscriptions\PutSubscriptionsRecipient;
use Courier\Lists\Subscriptions\RecipientPreferences;
use Courier\Lists\Subscriptions\SubscriptionAddParams;
use Courier\Lists\Subscriptions\SubscriptionListParams;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\Lists\Subscriptions\SubscriptionSubscribeParams;
use Courier\Lists\Subscriptions\SubscriptionSubscribeUserParams;
use Courier\Lists\Subscriptions\SubscriptionUnsubscribeUserParams;
use Courier\RequestOptions;
use Courier\ServiceContracts\Lists\SubscriptionsContract;

use const Courier\Core\OMIT as omit;

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
     * @param string|null $cursor A unique identifier that allows for fetching the next set of list subscriptions
     *
     * @return SubscriptionListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function list(
        string $listID,
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): SubscriptionListResponse {
        $params = ['cursor' => $cursor];

        return $this->listRaw($listID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return SubscriptionListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        string $listID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): SubscriptionListResponse {
        [$parsed, $options] = SubscriptionListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @param list<PutSubscriptionsRecipient> $recipients
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        $recipients,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['recipients' => $recipients];

        return $this->addRaw($listID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function addRaw(
        string $listID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = SubscriptionAddParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @param list<PutSubscriptionsRecipient> $recipients
     *
     * @throws APIException
     */
    public function subscribe(
        string $listID,
        $recipients,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['recipients' => $recipients];

        return $this->subscribeRaw($listID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function subscribeRaw(
        string $listID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = SubscriptionSubscribeParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @param string $listID
     * @param RecipientPreferences|null $preferences
     *
     * @throws APIException
     */
    public function subscribeUser(
        string $userID,
        $listID,
        $preferences = omit,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = ['listID' => $listID, 'preferences' => $preferences];

        return $this->subscribeUserRaw($userID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function subscribeUserRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = SubscriptionSubscribeUserParams::parseRequest(
            $params,
            $requestOptions
        );
        $listID = $parsed['listID'];
        unset($parsed['listID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['lists/%1$s/subscriptions/%2$s', $listID, $userID],
            body: (object) array_diff_key($parsed, array_flip(['listID'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Delete a subscription to a list by list ID and user ID.
     *
     * @param string $listID
     *
     * @throws APIException
     */
    public function unsubscribeUser(
        string $userID,
        $listID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['listID' => $listID];

        return $this->unsubscribeUserRaw($userID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function unsubscribeUserRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = SubscriptionUnsubscribeUserParams::parseRequest(
            $params,
            $requestOptions
        );
        $listID = $parsed['listID'];
        unset($parsed['listID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['lists/%1$s/subscriptions/%2$s', $listID, $userID],
            options: $options,
            convert: null,
        );
    }
}
