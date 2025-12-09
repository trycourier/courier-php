<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\ListListResponse;
use Courier\Lists\SubscriptionList;
use Courier\NotificationPreferenceDetails;
use Courier\PreferenceStatus;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\Rule;
use Courier\ServiceContracts\ListsContract;
use Courier\Services\Lists\SubscriptionsService;

final class ListsService implements ListsContract
{
    /**
     * @api
     */
    public ListsRawService $raw;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ListsRawService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }

    /**
     * @api
     *
     * Returns a list based on the list ID provided.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     *
     * @throws APIException
     */
    public function retrieve(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): SubscriptionList {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($listID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create or replace an existing list with the supplied values.
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
    ): mixed {
        $params = ['name' => $name, 'preferences' => $preferences];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($listID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns all of the lists, with the ability to filter based on a pattern.
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
    ): ListListResponse {
        $params = ['cursor' => $cursor, 'pattern' => $pattern];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a list by list ID.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     *
     * @throws APIException
     */
    public function delete(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($listID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Restore a previously deleted list.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     *
     * @throws APIException
     */
    public function restore(
        string $listID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->restore($listID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
