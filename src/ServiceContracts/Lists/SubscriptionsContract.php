<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Lists;

use Courier\Core\Exceptions\APIException;
use Courier\Lists\Subscriptions\SubscriptionAddParams;
use Courier\Lists\Subscriptions\SubscriptionListParams;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\Lists\Subscriptions\SubscriptionSubscribeParams;
use Courier\Lists\Subscriptions\SubscriptionSubscribeUserParams;
use Courier\Lists\Subscriptions\SubscriptionUnsubscribeUserParams;
use Courier\RequestOptions;

interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param array<mixed>|SubscriptionListParams $params
     *
     * @throws APIException
     */
    public function list(
        string $listID,
        array|SubscriptionListParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionListResponse;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionAddParams $params
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        array|SubscriptionAddParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionSubscribeParams $params
     *
     * @throws APIException
     */
    public function subscribe(
        string $listID,
        array|SubscriptionSubscribeParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionSubscribeUserParams $params
     *
     * @throws APIException
     */
    public function subscribeUser(
        string $userID,
        array|SubscriptionSubscribeUserParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|SubscriptionUnsubscribeUserParams $params
     *
     * @throws APIException
     */
    public function unsubscribeUser(
        string $userID,
        array|SubscriptionUnsubscribeUserParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
