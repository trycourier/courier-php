<?php

namespace Courier\Send\Traits;

use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Send\Types\Channel;
use Courier\Send\Types\MessageContext;
use Courier\Send\Types\MessageMetadata;
use Courier\Send\Types\MessagePreferences;
use Courier\Send\Types\MessageProvidersType;
use Courier\Send\Types\Routing;
use Courier\Send\Types\Timeout;
use Courier\Send\Types\Delay;
use Courier\Send\Types\Expiry;

trait BaseMessage
{
    /**
     * @var ?array<string, mixed> $data An arbitrary object that includes any data you want to pass to the message.
    The data will populate the corresponding template or elements variables.
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    public ?array $data;

    /**
     * @var ?string $brandId
     */
    #[JsonProperty('brand_id')]
    public ?string $brandId;

    /**
     * @var ?array<string, Channel> $channels "Define run-time configuration for one or more channels. If you don't specify channels, the default configuration for each channel will be used. Valid ChannelId's are: email, sms, push, inbox, direct_message, banner, and webhook."
     */
    #[JsonProperty('channels'), ArrayType(['string' => Channel::class])]
    public ?array $channels;

    /**
     * @var ?MessageContext $context Context to load with this recipient. Will override any context set on message.context.
     */
    #[JsonProperty('context')]
    public ?MessageContext $context;

    /**
     * @var ?MessageMetadata $metadata Metadata such as utm tracking attached with the notification through this channel.
     */
    #[JsonProperty('metadata')]
    public ?MessageMetadata $metadata;

    /**
     * @var ?MessagePreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?MessagePreferences $preferences;

    /**
     * @var ?array<string, MessageProvidersType> $providers An object whose keys are valid provider identifiers which map to an object.
     */
    #[JsonProperty('providers'), ArrayType(['string' => MessageProvidersType::class])]
    public ?array $providers;

    /**
     * @var ?Routing $routing
     */
    #[JsonProperty('routing')]
    public ?Routing $routing;

    /**
     * @var ?Timeout $timeout Time in ms to attempt the channel before failing over to the next available channel.
     */
    #[JsonProperty('timeout')]
    public ?Timeout $timeout;

    /**
     * @var ?Delay $delay Defines the time to wait before delivering the message. You can specify one of the following options. Duration with the number of milliseconds to delay. Until with an ISO 8601 timestamp that specifies when it should be delivered. Until with an OpenStreetMap opening_hours-like format that specifies the [Delivery Window](https://www.courier.com/docs/platform/sending/failover/#delivery-window) (e.g., 'Mo-Fr 08:00-18:00pm')
     */
    #[JsonProperty('delay')]
    public ?Delay $delay;

    /**
     * @var ?Expiry $expiry "Expiry allows you to set an absolute or relative time in which a message expires.
    Note: This is only valid for the Courier Inbox channel as of 12-08-2022."
     */
    #[JsonProperty('expiry')]
    public ?Expiry $expiry;
}
