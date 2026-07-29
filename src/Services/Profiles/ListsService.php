<?php

declare(strict_types=1);

namespace Courier\Services\Profiles;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\Profiles\SubscribeToListsRequestItem;
use Courier\RequestOptions;
use Courier\ServiceContracts\Profiles\ListsContract;

/**
 * Store the contact information Courier delivers to for each user — email, phone number, push tokens, and any custom data you send to.
 *
 * @phpstan-import-type SubscribeToListsRequestItemShape from \Courier\Profiles\SubscribeToListsRequestItem
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ListsService implements ListsContract
{
    /**
     * @api
     */
    public ListsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ListsRawService($client);
    }

    /**
     * @api
     *
     * Returns the lists a user is subscribed to, with paging. Use it to check what a recipient will receive before sending to a list.
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
    ): ListGetResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes every list subscription for a user at once. Their profile and preferences are untouched, so this only affects list-targeted sends.
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): ListDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($userID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes a user to one or more lists, creating any list that does not yet exist. Optional preferences apply to each subscription.
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
    ): ListSubscribeResponse {
        $params = Util::removeNulls(
            [
                'lists' => $lists,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->subscribe($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
