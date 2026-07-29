<?php

declare(strict_types=1);

namespace Courier\Services\Profiles;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListRetrieveParams;
use Courier\Profiles\Lists\ListSubscribeParams;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\Profiles\SubscribeToListsRequestItem;
use Courier\RequestOptions;
use Courier\ServiceContracts\Profiles\ListsRawContract;

/**
 * Store the contact information Courier delivers to for each user — email, phone number, push tokens, and any custom data you send to.
 *
 * @phpstan-import-type SubscribeToListsRequestItemShape from \Courier\Profiles\SubscribeToListsRequestItem
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ListsRawService implements ListsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the lists a user is subscribed to, with paging. Use it to check what a recipient will receive before sending to a list.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array{cursor?: string|null}|ListRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ListGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|ListRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ListRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['profiles/%1$s/lists', $userID],
            query: $parsed,
            options: $options,
            convert: ListGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Removes every list subscription for a user at once. Their profile and preferences are untouched, so this only affects list-targeted sends.
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ListDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['profiles/%1$s/lists', $userID],
            options: $requestOptions,
            convert: ListDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Subscribes a user to one or more lists, creating any list that does not yet exist. Optional preferences apply to each subscription.
     *
     * @param string $userID path param: A unique identifier representing the user associated with the requested user profile
     * @param array{
     *   lists: list<SubscribeToListsRequestItem|SubscribeToListsRequestItemShape>,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|ListSubscribeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ListSubscribeResponse>
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        array|ListSubscribeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ListSubscribeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['profiles/%1$s/lists', $userID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: ListSubscribeResponse::class,
        );
    }
}
