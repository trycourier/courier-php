<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\Bulk\InboundBulkMessage;
use Courier\Bulk\InboundBulkMessageUser;
use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\MessageContext;
use Courier\NotificationPreferenceDetails;
use Courier\Preference;
use Courier\Preference\Source;
use Courier\PreferenceStatus;
use Courier\RecipientPreferences;
use Courier\RequestOptions;
use Courier\Rule;
use Courier\ServiceContracts\BulkContract;
use Courier\UserRecipient;

final class BulkService implements BulkContract
{
    /**
     * @api
     */
    public BulkRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BulkRawService($client);
    }

    /**
     * @api
     *
     * Ingest user data into a Bulk Job.
     *
     * **Important**: For email-based bulk jobs, each user must include `profile.email`
     * for provider routing to work correctly. The `to.email` field is not sufficient
     * for email provider routing.
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
     *   profile?: array<string,mixed>|null,
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
    ): mixed {
        $params = Util::removeNulls(['users' => $users]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->addUsers($jobID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates a new bulk job for sending messages to multiple recipients.
     *
     * **Required**: `message.event` (event ID or notification ID)
     *
     * **Optional (V2 format)**: `message.template` (notification ID) or `message.content` (Elemental content)
     * can be provided to override the notification associated with the event.
     *
     * @param array{
     *   event: string,
     *   brand?: string|null,
     *   content?: array<string,mixed>|null,
     *   data?: array<string,mixed>|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     *   template?: string|null,
     * }|InboundBulkMessage $message Bulk message definition. Supports two formats:
     * - V1 format: Requires `event` field (event ID or notification ID)
     * - V2 format: Optionally use `template` (notification ID) or `content` (Elemental content) in addition to `event`
     *
     * @throws APIException
     */
    public function createJob(
        array|InboundBulkMessage $message,
        ?RequestOptions $requestOptions = null
    ): BulkNewJobResponse {
        $params = Util::removeNulls(['message' => $message]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createJob(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get Bulk Job Users
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
    ): BulkListUsersResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listUsers($jobID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a bulk job
     *
     * @param string $jobID A unique identifier representing the bulk job
     *
     * @throws APIException
     */
    public function retrieveJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BulkGetJobResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveJob($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Run a bulk job
     *
     * @param string $jobID A unique identifier representing the bulk job
     *
     * @throws APIException
     */
    public function runJob(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->runJob($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
