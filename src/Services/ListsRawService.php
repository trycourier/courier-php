<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\ListListParams;
use Courier\Lists\ListListResponse;
use Courier\Lists\ListUpdateParams;
use Courier\Lists\SubscriptionList;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\ServiceContracts\ListsRawContract;

/**
 * @phpstan-import-type RecipientPreferencesShape from \Courier\RecipientPreferences
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
     * Returns a list based on the list ID provided.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubscriptionList>
     *
     * @throws APIException
     */
    public function retrieve(
        string $listID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['lists/%1$s', $listID],
            options: $requestOptions,
            convert: SubscriptionList::class,
        );
    }

    /**
     * @api
     *
     * Create or replace an existing list with the supplied values.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param array{
     *   name: string,
     *   preferences?: RecipientPreferences|RecipientPreferencesShape|null,
     * }|ListUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $listID,
        array|ListUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ListUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['lists/%1$s', $listID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns all of the lists, with the ability to filter based on a pattern.
     *
     * @param array{cursor?: string|null, pattern?: string|null}|ListListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ListListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|ListListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ListListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'lists',
            query: $parsed,
            options: $options,
            convert: ListListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a list by list ID.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $listID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['lists/%1$s', $listID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Restore a previously deleted list.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function restore(
        string $listID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['lists/%1$s/restore', $listID],
            options: $requestOptions,
            convert: null,
        );
    }
}
