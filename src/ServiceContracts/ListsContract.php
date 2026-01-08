<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Lists\ListListResponse;
use Courier\Lists\SubscriptionList;
use Courier\RecipientPreferences;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RecipientPreferencesShape from \Courier\RecipientPreferences
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface ListsContract
{
    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $listID,
        RequestOptions|array|null $requestOptions = null
    ): SubscriptionList;

    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param RecipientPreferences|RecipientPreferencesShape|null $preferences
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $listID,
        string $name,
        RecipientPreferences|array|null $preferences = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next page of lists
     * @param string|null $pattern "A pattern used to filter the list items returned. Pattern types supported: exact match on `list_id` or a pattern of one or more pattern parts. you may replace a part with either: `*` to match all parts in that position, or `**` to signify a wildcard `endsWith` pattern match."
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $pattern = null,
        RequestOptions|array|null $requestOptions = null,
    ): ListListResponse;

    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $listID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function restore(
        string $listID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
