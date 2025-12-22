<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams;

use Courier\AudienceRecipient;
use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;
use Courier\ListPatternRecipient;
use Courier\ListRecipient;
use Courier\MessageContext;
use Courier\MsTeamsRecipient;
use Courier\PagerdutyRecipient;
use Courier\Send\SendMessageParams\Message\Channel;
use Courier\Send\SendMessageParams\Message\Delay;
use Courier\Send\SendMessageParams\Message\Expiry;
use Courier\Send\SendMessageParams\Message\Metadata;
use Courier\Send\SendMessageParams\Message\Preferences;
use Courier\Send\SendMessageParams\Message\Provider;
use Courier\Send\SendMessageParams\Message\Routing;
use Courier\Send\SendMessageParams\Message\Timeout;
use Courier\SlackRecipient;
use Courier\UserRecipient;
use Courier\WebhookRecipient;

/**
 * The message property has the following primary top-level properties. They define the destination and content of the message.
 *
 * @phpstan-import-type ChannelShape from \Courier\Send\SendMessageParams\Message\Channel
 * @phpstan-import-type ContentShape from \Courier\Send\SendMessageParams\Message\Content
 * @phpstan-import-type MessageContextShape from \Courier\MessageContext
 * @phpstan-import-type DelayShape from \Courier\Send\SendMessageParams\Message\Delay
 * @phpstan-import-type ExpiryShape from \Courier\Send\SendMessageParams\Message\Expiry
 * @phpstan-import-type MetadataShape from \Courier\Send\SendMessageParams\Message\Metadata
 * @phpstan-import-type PreferencesShape from \Courier\Send\SendMessageParams\Message\Preferences
 * @phpstan-import-type ProviderShape from \Courier\Send\SendMessageParams\Message\Provider
 * @phpstan-import-type RoutingShape from \Courier\Send\SendMessageParams\Message\Routing
 * @phpstan-import-type TimeoutShape from \Courier\Send\SendMessageParams\Message\Timeout
 * @phpstan-import-type ToShape from \Courier\Send\SendMessageParams\Message\To
 *
 * @phpstan-type MessageShape = array{
 *   brandID?: string|null,
 *   channels?: array<string,ChannelShape>|null,
 *   content?: ContentShape|null,
 *   context?: null|MessageContext|MessageContextShape,
 *   data?: array<string,mixed>|null,
 *   delay?: null|Delay|DelayShape,
 *   expiry?: null|Expiry|ExpiryShape,
 *   metadata?: null|Metadata|MetadataShape,
 *   preferences?: null|Preferences|PreferencesShape,
 *   providers?: array<string,ProviderShape>|null,
 *   routing?: null|Routing|RoutingShape,
 *   template?: string|null,
 *   timeout?: null|Timeout|TimeoutShape,
 *   to?: ToShape|null,
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
     */
    #[Optional(nullable: true)]
    public UserRecipient|AudienceRecipient|ListRecipient|ListPatternRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|null $to;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,ChannelShape>|null $channels
     * @param ContentShape|null $content
     * @param MessageContext|MessageContextShape|null $context
     * @param array<string,mixed>|null $data
     * @param Delay|DelayShape|null $delay
     * @param Expiry|ExpiryShape|null $expiry
     * @param Metadata|MetadataShape|null $metadata
     * @param Preferences|PreferencesShape|null $preferences
     * @param array<string,ProviderShape>|null $providers
     * @param Routing|RoutingShape|null $routing
     * @param Timeout|TimeoutShape|null $timeout
     * @param ToShape|null $to
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
        UserRecipient|array|AudienceRecipient|ListRecipient|ListPatternRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|null $to = null,
    ): self {
        $self = new self;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $channels && $self['channels'] = $channels;
        null !== $content && $self['content'] = $content;
        null !== $context && $self['context'] = $context;
        null !== $data && $self['data'] = $data;
        null !== $delay && $self['delay'] = $delay;
        null !== $expiry && $self['expiry'] = $expiry;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $preferences && $self['preferences'] = $preferences;
        null !== $providers && $self['providers'] = $providers;
        null !== $routing && $self['routing'] = $routing;
        null !== $template && $self['template'] = $template;
        null !== $timeout && $self['timeout'] = $timeout;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Define run-time configuration for channels. Valid ChannelId's: email, sms, push, inbox, direct_message, banner, webhook.
     *
     * @param array<string,ChannelShape>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    /**
     * Describes content that will work for email, inbox, push, chat, or any channel id.
     *
     * @param ContentShape $content
     */
    public function withContent(
        ElementalContentSugar|array|ElementalContent $content
    ): self {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * @param MessageContext|MessageContextShape|null $context
     */
    public function withContext(MessageContext|array|null $context): self
    {
        $self = clone $this;
        $self['context'] = $context;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param Delay|DelayShape|null $delay
     */
    public function withDelay(Delay|array|null $delay): self
    {
        $self = clone $this;
        $self['delay'] = $delay;

        return $self;
    }

    /**
     * @param Expiry|ExpiryShape|null $expiry
     */
    public function withExpiry(Expiry|array|null $expiry): self
    {
        $self = clone $this;
        $self['expiry'] = $expiry;

        return $self;
    }

    /**
     * @param Metadata|MetadataShape|null $metadata
     */
    public function withMetadata(Metadata|array|null $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param Preferences|PreferencesShape|null $preferences
     */
    public function withPreferences(Preferences|array|null $preferences): self
    {
        $self = clone $this;
        $self['preferences'] = $preferences;

        return $self;
    }

    /**
     * @param array<string,ProviderShape>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $self = clone $this;
        $self['providers'] = $providers;

        return $self;
    }

    /**
     * Customize which channels/providers Courier may deliver the message through.
     *
     * @param Routing|RoutingShape|null $routing
     */
    public function withRouting(Routing|array|null $routing): self
    {
        $self = clone $this;
        $self['routing'] = $routing;

        return $self;
    }

    public function withTemplate(?string $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

        return $self;
    }

    /**
     * @param Timeout|TimeoutShape|null $timeout
     */
    public function withTimeout(Timeout|array|null $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * The recipient or a list of recipients of the message.
     *
     * @param ToShape|null $to
     */
    public function withTo(
        UserRecipient|array|AudienceRecipient|ListRecipient|ListPatternRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|null $to,
    ): self {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
