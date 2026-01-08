<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Lists;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\Subscriptions\SubscriptionAddParams;
use Courier\Lists\Subscriptions\SubscriptionListParams;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\Lists\Subscriptions\SubscriptionSubscribeParams;
use Courier\Lists\Subscriptions\SubscriptionSubscribeUserParams;
use Courier\Lists\Subscriptions\SubscriptionUnsubscribeUserParams;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface SubscriptionsRawContract
{
    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param array<string,mixed>|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubscriptionListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $listID,
        array|SubscriptionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param array<string,mixed>|SubscriptionAddParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        array|SubscriptionAddParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param array<string,mixed>|SubscriptionSubscribeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function subscribe(
        string $listID,
        array|SubscriptionSubscribeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $userID Path param: A unique identifier representing the recipient associated with the list
     * @param array<string,mixed>|SubscriptionSubscribeUserParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function subscribeUser(
        string $userID,
        array|SubscriptionSubscribeUserParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $userID A unique identifier representing the recipient associated with the list
     * @param array<string,mixed>|SubscriptionUnsubscribeUserParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function unsubscribeUser(
        string $userID,
        array|SubscriptionUnsubscribeUserParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
