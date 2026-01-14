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
     * Get the list's subscriptions.
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
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param list<PutSubscriptionsRecipient|PutSubscriptionsRecipientShape> $recipients
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        array $recipients,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['recipients' => $recipients]);

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
     * Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).
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
     * Delete a subscription to a list by list ID and user ID.
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
