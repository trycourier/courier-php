<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\MessageContext;
use Courier\MessageRouting;
use Courier\MessageRoutingChannel;
use Courier\Preference;
use Courier\Preference\Source;
use Courier\PreferenceStatus;
use Courier\RequestOptions;
use Courier\Rule;
use Courier\Send\SendMessageParams\Message\Channel\RoutingMethod;
use Courier\Send\SendMessageParams\Message\Routing\Method;
use Courier\Send\SendMessageParams\Message\Timeout\Criteria;
use Courier\Send\SendMessageResponse;
use Courier\ServiceContracts\SendContract;
use Courier\UserRecipient;

final class SendService implements SendContract
{
    /**
     * @api
     */
    public SendRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SendRawService($client);
    }

    /**
     * @api
     *
     * Send a message to one or more recipients.
     *
     * @param array{
     *   brandID?: string|null,
     *   channels?: array<string,array{
     *     brandID?: string|null,
     *     if?: string|null,
     *     metadata?: array{
     *       utm?: array{
     *         campaign?: string|null,
     *         content?: string|null,
     *         medium?: string|null,
     *         source?: string|null,
     *         term?: string|null,
     *       }|null,
     *     }|null,
     *     override?: array<string,mixed>|null,
     *     providers?: list<string>|null,
     *     routingMethod?: 'all'|'single'|RoutingMethod|null,
     *     timeouts?: array{channel?: int|null, provider?: int|null}|null,
     *   }>|null,
     *   content?: array<string,mixed>,
     *   context?: array{tenantID?: string|null}|MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   delay?: array{
     *     duration?: int|null, timezone?: string|null, until?: string|null
     *   }|null,
     *   expiry?: array{expiresIn: string|int, expiresAt?: string|null}|null,
     *   metadata?: array{
     *     event?: string|null,
     *     tags?: list<string>|null,
     *     traceID?: string|null,
     *     utm?: array{
     *       campaign?: string|null,
     *       content?: string|null,
     *       medium?: string|null,
     *       source?: string|null,
     *       term?: string|null,
     *     }|null,
     *   }|null,
     *   preferences?: array{subscriptionTopicID: string}|null,
     *   providers?: array<string,array{
     *     if?: string|null,
     *     metadata?: array{
     *       utm?: array{
     *         campaign?: string|null,
     *         content?: string|null,
     *         medium?: string|null,
     *         source?: string|null,
     *         term?: string|null,
     *       }|null,
     *     }|null,
     *     override?: array<string,mixed>|null,
     *     timeouts?: int|null,
     *   }>|null,
     *   routing?: array{
     *     channels: list<string|MessageRouting|MessageRoutingChannel>,
     *     method: 'all'|'single'|Method,
     *   }|null,
     *   template?: string|null,
     *   timeout?: array{
     *     channel?: array<string,int>|null,
     *     criteria?: 'no-escalation'|'delivered'|'viewed'|'engaged'|Criteria|null,
     *     escalation?: int|null,
     *     message?: int|null,
     *     provider?: array<string,int>|null,
     *   }|null,
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
     *   }|UserRecipient|list<array{
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
     *   }>|null,
     * } $message The message property has the following primary top-level properties. They define the destination and content of the message.
     *
     * @throws APIException
     */
    public function message(
        array $message,
        ?RequestOptions $requestOptions = null
    ): SendMessageResponse {
        $params = Util::removeNulls(['message' => $message]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->message(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
