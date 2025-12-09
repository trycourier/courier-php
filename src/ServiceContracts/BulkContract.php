<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Bulk\InboundBulkMessage;
use Courier\Bulk\InboundBulkMessageUser;
use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Core\Exceptions\APIException;
use Courier\MessageContext;
use Courier\NotificationPreferenceDetails;
use Courier\Preference;
use Courier\Preference\Source;
use Courier\PreferenceStatus;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\Rule;
use Courier\UserRecipient;

interface BulkContract
{
    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param list<array{
     *   data?: mixed,
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
     *   profile?: mixed,
     *   recipient?: string|null,
     *   to?: array{
     *     accountID?: string|null,
     *     context?: array{tenantID?: string|null}|MessageContext|null,
     *     data?: array<string,mixed>|null,
     *     email?: string|null,
     *     listID?: string|null,
     *     locale?: string|null,
     *     phoneNumber?: string|null,
     *     preferences?: array{
     *       notifications: array<string,array{
     *         status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *         channelPreferences?: list<array{
     *           channel: 'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification,
     *         }|ChannelPreference>|null,
     *         rules?: list<array{until: string, start?: string|null}|Rule>|null,
     *         source?: 'subscription'|'list'|'recipient'|Source|null,
     *       }|Preference>,
     *       categories?: array<string,array{
     *         status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *         channelPreferences?: list<array{
     *           channel: 'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification,
     *         }|ChannelPreference>|null,
     *         rules?: list<array{until: string, start?: string|null}|Rule>|null,
     *         source?: 'subscription'|'list'|'recipient'|Source|null,
     *       }|Preference>|null,
     *       templateID?: string|null,
     *     }|null,
     *     tenantID?: string|null,
     *     userID?: string|null,
     *   }|UserRecipient|null,
     * }|InboundBulkMessageUser> $users
     *
     * @throws APIException
     */
    public function addUsers(
        string $jobID,
        array $users,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param InboundBulkMessage|array<string,mixed> $message
     *
     * @throws APIException
     */
    public function createJob(
        InboundBulkMessage|array $message,
        ?RequestOptions $requestOptions = null
    ): BulkNewJobResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     * @param string|null $cursor A unique identifier that allows for fetching the next set of users added to the bulk job
     *
     * @throws APIException
     */
    public function listUsers(
        string $jobID,
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null,
    ): BulkListUsersResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     *
     * @throws APIException
     */
    public function retrieveJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BulkGetJobResponse;

    /**
     * @api
     *
     * @param string $jobID A unique identifier representing the bulk job
     *
     * @throws APIException
     */
    public function runJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
