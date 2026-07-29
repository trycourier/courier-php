<?php

declare(strict_types=1);

namespace Courier\Services\Lists;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Lists\PutSubscriptionsRecipient;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\ServiceContracts\Lists\SubscriptionsContract;

/**
 * Manage static groups of users that you subscribe explicitly, and send to them by list id or list pattern.
 *
 * @phpstan-import-type RecipientPreferencesShape from \Courier\RecipientPreferences
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 * @phpstan-import-type PutSubscriptionsRecipientShape from \Courier\Lists\PutSubscriptionsRecipient
 */
final class SubscriptionsService implements SubscriptionsContract
{
    /**
     * @api
     */
    public SubscriptionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SubscriptionsRawService($client);
    }

    /**
     * @api
     *
     * Returns the users subscribed to a list with paging, each with the preferences recorded for that subscription.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param string|null $cursor A unique identifier that allows for fetching the next set of list subscriptions
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $listID,
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null,
    ): SubscriptionListResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($listID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes additional users to the list, without modifying existing subscriptions. If the list does not exist, it will be automatically created.
     *
     * @param string $listID path param: A unique identifier representing the list you wish to retrieve
     * @param list<PutSubscriptionsRecipient|PutSubscriptionsRecipientShape> $recipients Body param
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        array $recipients,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'recipients' => $recipients,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->add($listID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes the users to the list, overwriting existing subscriptions. If the list does not exist, it will be automatically created.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param list<PutSubscriptionsRecipient|PutSubscriptionsRecipientShape> $recipients
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function subscribe(
        string $listID,
        array $recipients,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['recipients' => $recipients]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->subscribe($listID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes one user to a list, creating the list if it does not yet exist. Optional preferences apply to this subscription only.
     *
     * @param string $userID Path param: A unique identifier representing the recipient associated with the list
     * @param string $listID path param: A unique identifier representing the list you wish to retrieve
     * @param RecipientPreferences|RecipientPreferencesShape|null $preferences Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function subscribeUser(
        string $userID,
        string $listID,
        RecipientPreferences|array|null $preferences = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['listID' => $listID, 'preferences' => $preferences]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->subscribeUser($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes one user's subscription to a list, addressed by list id and user id. The user's profile and other subscriptions are separate resources.
     *
     * @param string $userID A unique identifier representing the recipient associated with the list
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unsubscribeUser(
        string $userID,
        string $listID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['listID' => $listID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->unsubscribeUser($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
