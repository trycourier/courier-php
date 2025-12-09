<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Lists;

use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Core\Exceptions\APIException;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\NotificationPreferenceDetails;
use Courier\PreferenceStatus;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\Rule;

interface SubscriptionsContract
{
    /**
     * @api
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
    ): SubscriptionListResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;
}
