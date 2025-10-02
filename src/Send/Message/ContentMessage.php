<?php

declare(strict_types=1);

namespace Courier\Send\Message;

use Courier\Bulk\UserRecipient;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessage\Channel;
use Courier\Send\BaseMessage\Delay;
use Courier\Send\BaseMessage\Expiry;
use Courier\Send\BaseMessage\Metadata;
use Courier\Send\BaseMessage\Preferences;
use Courier\Send\BaseMessage\Provider;
use Courier\Send\BaseMessage\Routing;
use Courier\Send\BaseMessage\Timeout;
use Courier\Send\BaseMessageSendTo\To;
use Courier\Send\BaseMessageSendTo\To\AudienceRecipient;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient;
use Courier\Send\BaseMessageSendTo\To\PagerdutyRecipient;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient;
use Courier\Send\BaseMessageSendTo\To\UnionMember1;
use Courier\Send\BaseMessageSendTo\To\UnionMember2;
use Courier\Send\BaseMessageSendTo\To\WebhookRecipient;
use Courier\Send\Content\ElementalContent;
use Courier\Send\Content\ElementalContentSugar;
use Courier\Send\MessageContext;
use Courier\Send\Recipient\AudienceRecipient as AudienceRecipient1;
use Courier\Send\Recipient\MsTeamsRecipient as MsTeamsRecipient1;
use Courier\Send\Recipient\PagerdutyRecipient as PagerdutyRecipient1;
use Courier\Send\Recipient\SlackRecipient as SlackRecipient1;
use Courier\Send\Recipient\UnionMember1 as UnionMember11;
use Courier\Send\Recipient\UnionMember2 as UnionMember21;
use Courier\Send\Recipient\WebhookRecipient as WebhookRecipient1;

/**
 * Describes the content of the message in a way that will work for email, push, chat, or any channel.
 *
 * @phpstan-type content_message = array{
 *   brandID?: string|null,
 *   channels?: array<string, Channel>|null,
 *   context?: MessageContext,
 *   data?: array<string, mixed>|null,
 *   delay?: Delay|null,
 *   expiry?: Expiry|null,
 *   metadata?: Metadata|null,
 *   preferences?: Preferences|null,
 *   providers?: array<string, Provider>|null,
 *   routing?: Routing|null,
 *   timeout?: Timeout|null,
 *   to?: null|AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|list<AudienceRecipient1|UnionMember11|UnionMember21|UserRecipient|SlackRecipient1|MsTeamsRecipient1|PagerdutyRecipient1|WebhookRecipient1|array<string,
 *   mixed,>>|array<string, mixed>,
 *   content: ElementalContent|ElementalContentSugar,
 * }
 */
final class ContentMessage implements BaseModel
{
    /** @use SdkModel<content_message> */
    use SdkModel;

    #[Api('brand_id', nullable: true, optional: true)]
    public ?string $brandID;

    /**
     * "Define run-time configuration for one or more channels. If you don't specify channels, the default configuration for each channel will be used. Valid ChannelId's are: email, sms, push, inbox, direct_message, banner, and webhook.".
     *
     * @var array<string, Channel>|null $channels
     */
    #[Api(map: Channel::class, nullable: true, optional: true)]
    public ?array $channels;

    #[Api(optional: true)]
    public ?MessageContext $context;

    /**
     * An arbitrary object that includes any data you want to pass to the message.
     * The data will populate the corresponding template or elements variables.
     *
     * @var array<string, mixed>|null $data
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /**
     * Defines the time to wait before delivering the message. You can specify one of the following options. Duration with the number of milliseconds to delay. Until with an ISO 8601 timestamp that specifies when it should be delivered. Until with an OpenStreetMap opening_hours-like format that specifies the [Delivery Window](https://www.courier.com/docs/platform/sending/failover/#delivery-window) (e.g., 'Mo-Fr 08:00-18:00pm').
     */
    #[Api(nullable: true, optional: true)]
    public ?Delay $delay;

    /**
     * "Expiry allows you to set an absolute or relative time in which a message expires.
     * Note: This is only valid for the Courier Inbox channel as of 12-08-2022.".
     */
    #[Api(nullable: true, optional: true)]
    public ?Expiry $expiry;

    /**
     * Metadata such as utm tracking attached with the notification through this channel.
     */
    #[Api(nullable: true, optional: true)]
    public ?Metadata $metadata;

    #[Api(nullable: true, optional: true)]
    public ?Preferences $preferences;

    /**
     * An object whose keys are valid provider identifiers which map to an object.
     *
     * @var array<string, Provider>|null $providers
     */
    #[Api(map: Provider::class, nullable: true, optional: true)]
    public ?array $providers;

    /**
     * Allows you to customize which channel(s) Courier will potentially deliver the message.
     * If no routing key is specified, Courier will use the default routing configuration or
     * routing defined by the template.
     */
    #[Api(nullable: true, optional: true)]
    public ?Routing $routing;

    /**
     * Time in ms to attempt the channel before failing over to the next available channel.
     */
    #[Api(nullable: true, optional: true)]
    public ?Timeout $timeout;

    /**
     * The recipient or a list of recipients of the message.
     *
     * @var AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|list<AudienceRecipient1|UnionMember11|UnionMember21|UserRecipient|SlackRecipient1|MsTeamsRecipient1|PagerdutyRecipient1|WebhookRecipient1|array<string,
     * mixed,>>|array<string, mixed>|null $to
     */
    #[Api(union: To::class, nullable: true, optional: true)]
    public AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|array|null $to;

    /**
     * Syntatic Sugar to provide a fast shorthand for Courier Elemental Blocks.
     */
    #[Api]
    public ElementalContent|ElementalContentSugar $content;

    /**
     * `new ContentMessage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ContentMessage::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ContentMessage)->withContent(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, Channel>|null $channels
     * @param array<string, mixed>|null $data
     * @param array<string, Provider>|null $providers
     * @param AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|list<AudienceRecipient1|UnionMember11|UnionMember21|UserRecipient|SlackRecipient1|MsTeamsRecipient1|PagerdutyRecipient1|WebhookRecipient1|array<string,
     * mixed,>>|array<string, mixed>|null $to
     */
    public static function with(
        ElementalContent|ElementalContentSugar $content,
        ?string $brandID = null,
        ?array $channels = null,
        ?MessageContext $context = null,
        ?array $data = null,
        ?Delay $delay = null,
        ?Expiry $expiry = null,
        ?Metadata $metadata = null,
        ?Preferences $preferences = null,
        ?array $providers = null,
        ?Routing $routing = null,
        ?Timeout $timeout = null,
        AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|array|null $to = null,
    ): self {
        $obj = new self;

        $obj->content = $content;

        null !== $brandID && $obj->brandID = $brandID;
        null !== $channels && $obj->channels = $channels;
        null !== $context && $obj->context = $context;
        null !== $data && $obj->data = $data;
        null !== $delay && $obj->delay = $delay;
        null !== $expiry && $obj->expiry = $expiry;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $preferences && $obj->preferences = $preferences;
        null !== $providers && $obj->providers = $providers;
        null !== $routing && $obj->routing = $routing;
        null !== $timeout && $obj->timeout = $timeout;
        null !== $to && $obj->to = $to;

        return $obj;
    }

    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj->brandID = $brandID;

        return $obj;
    }

    /**
     * "Define run-time configuration for one or more channels. If you don't specify channels, the default configuration for each channel will be used. Valid ChannelId's are: email, sms, push, inbox, direct_message, banner, and webhook.".
     *
     * @param array<string, Channel>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $obj = clone $this;
        $obj->channels = $channels;

        return $obj;
    }

    public function withContext(MessageContext $context): self
    {
        $obj = clone $this;
        $obj->context = $context;

        return $obj;
    }

    /**
     * An arbitrary object that includes any data you want to pass to the message.
     * The data will populate the corresponding template or elements variables.
     *
     * @param array<string, mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * Defines the time to wait before delivering the message. You can specify one of the following options. Duration with the number of milliseconds to delay. Until with an ISO 8601 timestamp that specifies when it should be delivered. Until with an OpenStreetMap opening_hours-like format that specifies the [Delivery Window](https://www.courier.com/docs/platform/sending/failover/#delivery-window) (e.g., 'Mo-Fr 08:00-18:00pm').
     */
    public function withDelay(?Delay $delay): self
    {
        $obj = clone $this;
        $obj->delay = $delay;

        return $obj;
    }

    /**
     * "Expiry allows you to set an absolute or relative time in which a message expires.
     * Note: This is only valid for the Courier Inbox channel as of 12-08-2022.".
     */
    public function withExpiry(?Expiry $expiry): self
    {
        $obj = clone $this;
        $obj->expiry = $expiry;

        return $obj;
    }

    /**
     * Metadata such as utm tracking attached with the notification through this channel.
     */
    public function withMetadata(?Metadata $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    public function withPreferences(?Preferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }

    /**
     * An object whose keys are valid provider identifiers which map to an object.
     *
     * @param array<string, Provider>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $obj = clone $this;
        $obj->providers = $providers;

        return $obj;
    }

    /**
     * Allows you to customize which channel(s) Courier will potentially deliver the message.
     * If no routing key is specified, Courier will use the default routing configuration or
     * routing defined by the template.
     */
    public function withRouting(?Routing $routing): self
    {
        $obj = clone $this;
        $obj->routing = $routing;

        return $obj;
    }

    /**
     * Time in ms to attempt the channel before failing over to the next available channel.
     */
    public function withTimeout(?Timeout $timeout): self
    {
        $obj = clone $this;
        $obj->timeout = $timeout;

        return $obj;
    }

    /**
     * The recipient or a list of recipients of the message.
     *
     * @param AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|list<AudienceRecipient1|UnionMember11|UnionMember21|UserRecipient|SlackRecipient1|MsTeamsRecipient1|PagerdutyRecipient1|WebhookRecipient1|array<string,
     * mixed,>>|array<string, mixed>|null $to
     */
    public function withTo(
        AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|array|null $to,
    ): self {
        $obj = clone $this;
        $obj->to = $to;

        return $obj;
    }

    /**
     * Syntatic Sugar to provide a fast shorthand for Courier Elemental Blocks.
     */
    public function withContent(
        ElementalContent|ElementalContentSugar $content
    ): self {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }
}
