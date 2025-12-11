<?php

declare(strict_types=1);

namespace Courier\Services\Lists;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
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
use Courier\ServiceContracts\Lists\SubscriptionsRawContract;

final class SubscriptionsRawService implements SubscriptionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the list's subscriptions.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param array{cursor?: string|null}|SubscriptionListParams $params
     *
     * @return BaseResponse<SubscriptionListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $listID,
        array|SubscriptionListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
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
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param array{
     *   recipients: list<array{
     *     recipientID: string, preferences?: array<mixed>|RecipientPreferences|null
     *   }>,
     * }|SubscriptionAddParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        array|SubscriptionAddParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
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
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param array{
     *   recipients: list<array{
     *     recipientID: string, preferences?: array<mixed>|RecipientPreferences|null
     *   }>,
     * }|SubscriptionSubscribeParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function subscribe(
        string $listID,
        array|SubscriptionSubscribeParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
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
     * @param string $userID Path param: A unique identifier representing the recipient associated with the list
     * @param array{
     *   listID: string,
     *   preferences?: array{
     *     categories?: array<string,array<mixed>|NotificationPreferenceDetails>|null,
     *     notifications?: array<string,array<mixed>|NotificationPreferenceDetails>|null,
     *   }|RecipientPreferences|null,
     * }|SubscriptionSubscribeUserParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function subscribeUser(
        string $userID,
        array|SubscriptionSubscribeUserParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionSubscribeUserParams::parseRequest(
            $params,
            $requestOptions,
        );
        $listID = $parsed['listID'];
        unset($parsed['listID']);

        // @phpstan-ignore-next-line return.type
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
     * @param string $userID A unique identifier representing the recipient associated with the list
     * @param array{listID: string}|SubscriptionUnsubscribeUserParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function unsubscribeUser(
        string $userID,
        array|SubscriptionUnsubscribeUserParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionUnsubscribeUserParams::parseRequest(
            $params,
            $requestOptions,
        );
        $listID = $parsed['listID'];
        unset($parsed['listID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['lists/%1$s/subscriptions/%2$s', $listID, $userID],
            options: $options,
            convert: null,
        );
    }
}
