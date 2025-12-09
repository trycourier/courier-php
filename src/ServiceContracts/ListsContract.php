<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\ListListResponse;
use Courier\Lists\SubscriptionList;
use Courier\NotificationPreferenceDetails;
use Courier\PreferenceStatus;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\Rule;

interface ListsContract
{
    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     *
     * @throws APIException
     */
    public function retrieve(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): SubscriptionList;

    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param array{
     *   categories?: array<string,array{
     *     status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *     channelPreferences?: list<array{
     *       channel: 'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification,
     *     }|ChannelPreference>|null,
     *     rules?: list<array{until: string, start?: string|null}|Rule>|null,
     *   }|NotificationPreferenceDetails>|null,
     *   notifications?: array<string,array{
     *     status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *     channelPreferences?: list<array{
     *       channel: 'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification,
     *     }|ChannelPreference>|null,
     *     rules?: list<array{until: string, start?: string|null}|Rule>|null,
     *   }|NotificationPreferenceDetails>|null,
     * }|RecipientPreferences|null $preferences
     *
     * @throws APIException
     */
    public function update(
        string $listID,
        string $name,
        array|RecipientPreferences|null $preferences = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next page of lists
     * @param string|null $pattern "A pattern used to filter the list items returned. Pattern types supported: exact match on `list_id` or a pattern of one or more pattern parts. you may replace a part with either: `*` to match all parts in that position, or `**` to signify a wildcard `endsWith` pattern match."
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $pattern = null,
        ?RequestOptions $requestOptions = null,
    ): ListListResponse;

    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     *
     * @throws APIException
     */
    public function delete(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     *
     * @throws APIException
     */
    public function restore(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
