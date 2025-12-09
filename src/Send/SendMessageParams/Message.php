<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalActionNodeWithType;
use Courier\ElementalChannelNodeWithType;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;
use Courier\ElementalDividerNodeWithType;
use Courier\ElementalImageNodeWithType;
use Courier\ElementalMetaNodeWithType;
use Courier\ElementalQuoteNodeWithType;
use Courier\ElementalTextNodeWithType;
use Courier\MessageContext;
use Courier\Recipient;
use Courier\Send\SendMessageParams\Message\Channel;
use Courier\Send\SendMessageParams\Message\Channel\RoutingMethod;
use Courier\Send\SendMessageParams\Message\Channel\Timeouts;
use Courier\Send\SendMessageParams\Message\Delay;
use Courier\Send\SendMessageParams\Message\Expiry;
use Courier\Send\SendMessageParams\Message\Metadata;
use Courier\Send\SendMessageParams\Message\Preferences;
use Courier\Send\SendMessageParams\Message\Provider;
use Courier\Send\SendMessageParams\Message\Routing;
use Courier\Send\SendMessageParams\Message\Routing\Method;
use Courier\Send\SendMessageParams\Message\Timeout;
use Courier\Send\SendMessageParams\Message\Timeout\Criteria;
use Courier\Send\SendMessageParams\Message\To;
use Courier\UserRecipient;
use Courier\Utm;

/**
 * The message property has the following primary top-level properties. They define the destination and content of the message.
 *
 * @phpstan-type MessageShape = array{
 *   brandID?: string|null,
 *   channels?: array<string,Channel>|null,
 *   content?: null|ElementalContentSugar|ElementalContent,
 *   context?: MessageContext|null,
 *   data?: array<string,mixed>|null,
 *   delay?: Delay|null,
 *   expiry?: Expiry|null,
 *   metadata?: Metadata|null,
 *   preferences?: Preferences|null,
 *   providers?: array<string,Provider>|null,
 *   routing?: Routing|null,
 *   template?: string|null,
 *   timeout?: Timeout|null,
 *   to?: null|UserRecipient|list<Recipient>,
 * }
 */
final class Message implements BaseModel
{
    /** @use SdkModel<MessageShape> */
    use SdkModel;

    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Define run-time configuration for channels. Valid ChannelId's: email, sms, push, inbox, direct_message, banner, webhook.
     *
     * @var array<string,Channel>|null $channels
     */
    #[Optional(map: Channel::class, nullable: true)]
    public ?array $channels;

    /**
     * Describes content that will work for email, inbox, push, chat, or any channel id.
     */
    #[Optional]
    public ElementalContentSugar|ElementalContent|null $content;

    #[Optional(nullable: true)]
    public ?MessageContext $context;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    #[Optional(nullable: true)]
    public ?Delay $delay;

    #[Optional(nullable: true)]
    public ?Expiry $expiry;

    #[Optional(nullable: true)]
    public ?Metadata $metadata;

    #[Optional(nullable: true)]
    public ?Preferences $preferences;

    /** @var array<string,Provider>|null $providers */
    #[Optional(map: Provider::class, nullable: true)]
    public ?array $providers;

    /**
     * Customize which channels/providers Courier may deliver the message through.
     */
    #[Optional(nullable: true)]
    public ?Routing $routing;

    #[Optional(nullable: true)]
    public ?string $template;

    #[Optional(nullable: true)]
    public ?Timeout $timeout;

    /**
     * The recipient or a list of recipients of the message.
     *
     * @var UserRecipient|list<Recipient>|null $to
     */
    #[Optional(union: To::class, nullable: true)]
    public UserRecipient|array|null $to;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,Channel|array{
     *   brandID?: string|null,
     *   if?: string|null,
     *   metadata?: Channel\Metadata|null,
     *   override?: array<string,mixed>|null,
     *   providers?: list<string>|null,
     *   routingMethod?: value-of<RoutingMethod>|null,
     *   timeouts?: Timeouts|null,
     * }>|null $channels
     * @param ElementalContentSugar|array{
     *   body: string, title: string
     * }|ElementalContent|array{
     *   elements: list<ElementalTextNodeWithType|ElementalMetaNodeWithType|ElementalChannelNodeWithType|ElementalImageNodeWithType|ElementalActionNodeWithType|ElementalDividerNodeWithType|ElementalQuoteNodeWithType>,
     *   version: string,
     *   brand?: string|null,
     * } $content
     * @param MessageContext|array{tenantID?: string|null}|null $context
     * @param array<string,mixed>|null $data
     * @param Delay|array{duration?: int|null, until?: string|null}|null $delay
     * @param Expiry|array{expiresIn: string|int, expiresAt?: string|null}|null $expiry
     * @param Metadata|array{
     *   event?: string|null,
     *   tags?: list<string>|null,
     *   traceID?: string|null,
     *   utm?: Utm|null,
     * }|null $metadata
     * @param Preferences|array{subscriptionTopicID: string}|null $preferences
     * @param array<string,Provider|array{
     *   if?: string|null,
     *   metadata?: Provider\Metadata|null,
     *   override?: array<string,mixed>|null,
     *   timeouts?: int|null,
     * }>|null $providers
     * @param Routing|array{
     *   channels: list<mixed>, method: value-of<Method>
     * }|null $routing
     * @param Timeout|array{
     *   channel?: array<string,int>|null,
     *   criteria?: value-of<Criteria>|null,
     *   escalation?: int|null,
     *   message?: int|null,
     *   provider?: array<string,int>|null,
     * }|null $timeout
     * @param UserRecipient|array{
     *   accountID?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   listID?: string|null,
     *   locale?: string|null,
     *   phoneNumber?: string|null,
     *   preferences?: UserRecipient\Preferences|null,
     *   tenantID?: string|null,
     *   userID?: string|null,
     * }|list<Recipient|array{
     *   accountID?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   listID?: string|null,
     *   locale?: string|null,
     *   phoneNumber?: string|null,
     *   preferences?: Recipient\Preferences|null,
     *   tenantID?: string|null,
     *   userID?: string|null,
     * }>|null $to
     */
    public static function with(
        ?string $brandID = null,
        ?array $channels = null,
        ElementalContentSugar|array|ElementalContent|null $content = null,
        MessageContext|array|null $context = null,
        ?array $data = null,
        Delay|array|null $delay = null,
        Expiry|array|null $expiry = null,
        Metadata|array|null $metadata = null,
        Preferences|array|null $preferences = null,
        ?array $providers = null,
        Routing|array|null $routing = null,
        ?string $template = null,
        Timeout|array|null $timeout = null,
        UserRecipient|array|null $to = null,
    ): self {
        $obj = new self;

        null !== $brandID && $obj['brandID'] = $brandID;
        null !== $channels && $obj['channels'] = $channels;
        null !== $content && $obj['content'] = $content;
        null !== $context && $obj['context'] = $context;
        null !== $data && $obj['data'] = $data;
        null !== $delay && $obj['delay'] = $delay;
        null !== $expiry && $obj['expiry'] = $expiry;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $preferences && $obj['preferences'] = $preferences;
        null !== $providers && $obj['providers'] = $providers;
        null !== $routing && $obj['routing'] = $routing;
        null !== $template && $obj['template'] = $template;
        null !== $timeout && $obj['timeout'] = $timeout;
        null !== $to && $obj['to'] = $to;

        return $obj;
    }

    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj['brandID'] = $brandID;

        return $obj;
    }

    /**
     * Define run-time configuration for channels. Valid ChannelId's: email, sms, push, inbox, direct_message, banner, webhook.
     *
     * @param array<string,Channel|array{
     *   brandID?: string|null,
     *   if?: string|null,
     *   metadata?: Channel\Metadata|null,
     *   override?: array<string,mixed>|null,
     *   providers?: list<string>|null,
     *   routingMethod?: value-of<RoutingMethod>|null,
     *   timeouts?: Timeouts|null,
     * }>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $obj = clone $this;
        $obj['channels'] = $channels;

        return $obj;
    }

    /**
     * Describes content that will work for email, inbox, push, chat, or any channel id.
     *
     * @param ElementalContentSugar|array{
     *   body: string, title: string
     * }|ElementalContent|array{
     *   elements: list<ElementalTextNodeWithType|ElementalMetaNodeWithType|ElementalChannelNodeWithType|ElementalImageNodeWithType|ElementalActionNodeWithType|ElementalDividerNodeWithType|ElementalQuoteNodeWithType>,
     *   version: string,
     *   brand?: string|null,
     * } $content
     */
    public function withContent(
        ElementalContentSugar|array|ElementalContent $content
    ): self {
        $obj = clone $this;
        $obj['content'] = $content;

        return $obj;
    }

    /**
     * @param MessageContext|array{tenantID?: string|null}|null $context
     */
    public function withContext(MessageContext|array|null $context): self
    {
        $obj = clone $this;
        $obj['context'] = $context;

        return $obj;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }

    /**
     * @param Delay|array{duration?: int|null, until?: string|null}|null $delay
     */
    public function withDelay(Delay|array|null $delay): self
    {
        $obj = clone $this;
        $obj['delay'] = $delay;

        return $obj;
    }

    /**
     * @param Expiry|array{expiresIn: string|int, expiresAt?: string|null}|null $expiry
     */
    public function withExpiry(Expiry|array|null $expiry): self
    {
        $obj = clone $this;
        $obj['expiry'] = $expiry;

        return $obj;
    }

    /**
     * @param Metadata|array{
     *   event?: string|null,
     *   tags?: list<string>|null,
     *   traceID?: string|null,
     *   utm?: Utm|null,
     * }|null $metadata
     */
    public function withMetadata(Metadata|array|null $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * @param Preferences|array{subscriptionTopicID: string}|null $preferences
     */
    public function withPreferences(Preferences|array|null $preferences): self
    {
        $obj = clone $this;
        $obj['preferences'] = $preferences;

        return $obj;
    }

    /**
     * @param array<string,Provider|array{
     *   if?: string|null,
     *   metadata?: Provider\Metadata|null,
     *   override?: array<string,mixed>|null,
     *   timeouts?: int|null,
     * }>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $obj = clone $this;
        $obj['providers'] = $providers;

        return $obj;
    }

    /**
     * Customize which channels/providers Courier may deliver the message through.
     *
     * @param Routing|array{
     *   channels: list<mixed>, method: value-of<Method>
     * }|null $routing
     */
    public function withRouting(Routing|array|null $routing): self
    {
        $obj = clone $this;
        $obj['routing'] = $routing;

        return $obj;
    }

    public function withTemplate(?string $template): self
    {
        $obj = clone $this;
        $obj['template'] = $template;

        return $obj;
    }

    /**
     * @param Timeout|array{
     *   channel?: array<string,int>|null,
     *   criteria?: value-of<Criteria>|null,
     *   escalation?: int|null,
     *   message?: int|null,
     *   provider?: array<string,int>|null,
     * }|null $timeout
     */
    public function withTimeout(Timeout|array|null $timeout): self
    {
        $obj = clone $this;
        $obj['timeout'] = $timeout;

        return $obj;
    }

    /**
     * The recipient or a list of recipients of the message.
     *
     * @param UserRecipient|array{
     *   accountID?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   listID?: string|null,
     *   locale?: string|null,
     *   phoneNumber?: string|null,
     *   preferences?: UserRecipient\Preferences|null,
     *   tenantID?: string|null,
     *   userID?: string|null,
     * }|list<Recipient|array{
     *   accountID?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   listID?: string|null,
     *   locale?: string|null,
     *   phoneNumber?: string|null,
     *   preferences?: Recipient\Preferences|null,
     *   tenantID?: string|null,
     *   userID?: string|null,
     * }>|null $to
     */
    public function withTo(UserRecipient|array|null $to): self
    {
        $obj = clone $this;
        $obj['to'] = $to;

        return $obj;
    }
}
