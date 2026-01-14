<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Lists;

use Courier\Core\Exceptions\APIException;
use Courier\Lists\PutSubscriptionsRecipient;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\RecipientPreferences;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RecipientPreferencesShape from \Courier\RecipientPreferences
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 * @phpstan-import-type PutSubscriptionsRecipientShape from \Courier\Lists\PutSubscriptionsRecipient
 */
interface SubscriptionsContract
{
    /**
     * @api
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
    ): SubscriptionListResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;
}
