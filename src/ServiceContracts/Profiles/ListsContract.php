<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Profiles;

use Courier\Core\Exceptions\APIException;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\Profiles\SubscribeToListsRequestItem;
use Courier\RequestOptions;

/**
 * @phpstan-import-type SubscribeToListsRequestItemShape from \Courier\Profiles\SubscribeToListsRequestItem
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface ListsContract
{
    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param string|null $cursor a unique identifier that allows for fetching the next set of message statuses
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null,
    ): ListGetResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): ListDeleteResponse;

    /**
     * @api
     *
     * @param string $userID path param: A unique identifier representing the user associated with the requested user profile
     * @param list<SubscribeToListsRequestItem|SubscribeToListsRequestItemShape> $lists Body param
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        array $lists,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): ListSubscribeResponse;
}
