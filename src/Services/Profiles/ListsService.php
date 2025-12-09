<?php

declare(strict_types=1);

namespace Courier\Services\Profiles;

use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\NotificationPreferenceDetails;
use Courier\PreferenceStatus;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\Rule;
use Courier\ServiceContracts\Profiles\ListsContract;

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
     * Returns the subscribed lists for a specified user.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param string|null $cursor a unique identifier that allows for fetching the next set of message statuses
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null,
    ): ListGetResponse {
        $params = ['cursor' => $cursor];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes all list subscriptions for given user.
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): ListDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($userID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes the given user to one or more lists. If the list does not exist, it will be created.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param list<array{
     *   listID: string,
     *   preferences?: array{
     *     categories?: array<string,array{
     *       status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *       channelPreferences?: list<array{
     *         channel: 'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification,
     *       }|ChannelPreference>|null,
     *       rules?: list<array{until: string, start?: string|null}|Rule>|null,
     *     }|NotificationPreferenceDetails>|null,
     *     notifications?: array<string,array{
     *       status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *       channelPreferences?: list<array{
     *         channel: 'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification,
     *       }|ChannelPreference>|null,
     *       rules?: list<array{until: string, start?: string|null}|Rule>|null,
     *     }|NotificationPreferenceDetails>|null,
     *   }|RecipientPreferences|null,
     * }> $lists
     *
     * @throws APIException
     */
    public function subscribe(
        string $userID,
        array $lists,
        ?RequestOptions $requestOptions = null
    ): ListSubscribeResponse {
        $params = ['lists' => $lists];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->subscribe($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
