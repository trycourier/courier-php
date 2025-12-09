<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Profiles;

use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Core\Exceptions\APIException;
use Courier\NotificationPreferenceDetails;
use Courier\PreferenceStatus;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeResponse;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\Rule;

interface ListsContract
{
    /**
     * @api
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
    ): ListGetResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): ListDeleteResponse;

    /**
     * @api
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
    ): ListSubscribeResponse;
}
