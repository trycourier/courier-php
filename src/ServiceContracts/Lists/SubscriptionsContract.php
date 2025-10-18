<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Lists;

use Courier\Core\Exceptions\APIException;
use Courier\Lists\PutSubscriptionsRecipient;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\RecipientPreferences;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of list subscriptions
     *
     * @throws APIException
     */
    public function list(
        string $listID,
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): SubscriptionListResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listRaw(
        string $listID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): SubscriptionListResponse;

    /**
     * @api
     *
     * @param list<PutSubscriptionsRecipient> $recipients
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        $recipients,
        ?RequestOptions $requestOptions = null
    ): mixed;

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
    ): mixed;

    /**
     * @api
     *
     * @param list<PutSubscriptionsRecipient> $recipients
     *
     * @throws APIException
     */
    public function subscribe(
        string $listID,
        $recipients,
        ?RequestOptions $requestOptions = null
    ): mixed;

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
    ): mixed;

    /**
     * @api
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
    ): mixed;

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
    ): mixed;

    /**
     * @api
     *
     * @param string $listID
     *
     * @throws APIException
     */
    public function unsubscribeUser(
        string $userID,
        $listID,
        ?RequestOptions $requestOptions = null
    ): mixed;

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
    ): mixed;
}
