<?php

declare(strict_types=1);

namespace Courier\Services\Lists;

use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\NotificationPreferenceDetails;
use Courier\PreferenceStatus;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\Rule;
use Courier\ServiceContracts\Lists\SubscriptionsContract;

final class SubscriptionsService implements SubscriptionsContract
{
    /**
     * @api
     */
    public SubscriptionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SubscriptionsRawService($client);
    }

    /**
     * @api
     *
     * Get the list's subscriptions.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param string|null $cursor A unique identifier that allows for fetching the next set of list subscriptions
     *
     * @throws APIException
     */
    public function list(
        string $listID,
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionListResponse {
        $params = ['cursor' => $cursor];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($listID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes additional users to the list, without modifying existing subscriptions. If the list does not exist, it will be automatically created.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param list<array{
     *   recipientID: string,
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
     * }> $recipients
     *
     * @throws APIException
     */
    public function add(
        string $listID,
        array $recipients,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['recipients' => $recipients];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->add($listID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribes the users to the list, overwriting existing subscriptions. If the list does not exist, it will be automatically created.
     *
     * @param string $listID a unique identifier representing the list you wish to retrieve
     * @param list<array{
     *   recipientID: string,
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
     * }> $recipients
     *
     * @throws APIException
     */
    public function subscribe(
        string $listID,
        array $recipients,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['recipients' => $recipients];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->subscribe($listID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).
     *
     * @param string $userID Path param: A unique identifier representing the recipient associated with the list
     * @param string $listID path param: A unique identifier representing the list you wish to retrieve
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
     * }|RecipientPreferences|null $preferences Body param:
     *
     * @throws APIException
     */
    public function subscribeUser(
        string $userID,
        string $listID,
        array|RecipientPreferences|null $preferences = null,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = ['listID' => $listID, 'preferences' => $preferences];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->subscribeUser($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a subscription to a list by list ID and user ID.
     *
     * @param string $userID A unique identifier representing the recipient associated with the list
     * @param string $listID a unique identifier representing the list you wish to retrieve
     *
     * @throws APIException
     */
    public function unsubscribeUser(
        string $userID,
        string $listID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['listID' => $listID];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->unsubscribeUser($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
