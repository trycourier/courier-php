<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams;

use Courier\Bulk\UserRecipient;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContentSugar;
use Courier\Send\MessageContext;
use Courier\Send\Recipient;
use Courier\Send\SendMessageParams\Message\Channel;
use Courier\Send\SendMessageParams\Message\Delay;
use Courier\Send\SendMessageParams\Message\Expiry;
use Courier\Send\SendMessageParams\Message\Metadata;
use Courier\Send\SendMessageParams\Message\Preferences;
use Courier\Send\SendMessageParams\Message\Provider;
use Courier\Send\SendMessageParams\Message\Routing;
use Courier\Send\SendMessageParams\Message\Timeout;
use Courier\Send\SendMessageParams\Message\To;
use Courier\Tenants\Templates\ElementalContent;

/**
 * The message property has the following primary top-level properties. They define the destination and content of the message.
 *
 * @phpstan-type message_alias = array{
 *   brandID?: string|null,
 *   channels?: array<string, Channel>|null,
 *   content?: ElementalContentSugar|ElementalContent,
 *   context?: MessageContext|null,
 *   data?: array<string, mixed>|null,
 *   delay?: Delay|null,
 *   expiry?: Expiry|null,
 *   metadata?: Metadata|null,
 *   preferences?: Preferences|null,
 *   providers?: array<string, Provider>|null,
 *   routing?: Routing|null,
 *   template?: string|null,
 *   timeout?: Timeout|null,
 *   to?: null|UserRecipient|list<Recipient>,
 * }
 */
final class Message implements BaseModel
{
    /** @use SdkModel<message_alias> */
    use SdkModel;

    #[Api('brand_id', nullable: true, optional: true)]
    public ?string $brandID;

    /**
     * Define run-time configuration for channels. Valid ChannelId's: email, sms, push, inbox, direct_message, banner, webhook.
     *
     * @var array<string, Channel>|null $channels
     */
    #[Api(map: Channel::class, nullable: true, optional: true)]
    public ?array $channels;

    /**
     * Describes content that will work for email, inbox, push, chat, or any channel id.
     */
    #[Api(optional: true)]
    public ElementalContentSugar|ElementalContent|null $content;

    #[Api(nullable: true, optional: true)]
    public ?MessageContext $context;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    #[Api(nullable: true, optional: true)]
    public ?Delay $delay;

    #[Api(nullable: true, optional: true)]
    public ?Expiry $expiry;

    #[Api(nullable: true, optional: true)]
    public ?Metadata $metadata;

    #[Api(nullable: true, optional: true)]
    public ?Preferences $preferences;

    /** @var array<string, Provider>|null $providers */
    #[Api(map: Provider::class, nullable: true, optional: true)]
    public ?array $providers;

    /**
     * Customize which channels/providers Courier may deliver the message through.
     */
    #[Api(nullable: true, optional: true)]
    public ?Routing $routing;

    /**
     * The id of the template you want to send.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $template;

    #[Api(nullable: true, optional: true)]
    public ?Timeout $timeout;

    /**
     * The recipient or a list of recipients of the message.
     *
     * @var UserRecipient|list<Recipient>|null $to
     */
    #[Api(union: To::class, nullable: true, optional: true)]
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
     * @param array<string, Channel>|null $channels
     * @param array<string, mixed>|null $data
     * @param array<string, Provider>|null $providers
     * @param UserRecipient|list<Recipient>|null $to
     */
    public static function with(
        ?string $brandID = null,
        ?array $channels = null,
        ElementalContentSugar|ElementalContent|null $content = null,
        ?MessageContext $context = null,
        ?array $data = null,
        ?Delay $delay = null,
        ?Expiry $expiry = null,
        ?Metadata $metadata = null,
        ?Preferences $preferences = null,
        ?array $providers = null,
        ?Routing $routing = null,
        ?string $template = null,
        ?Timeout $timeout = null,
        UserRecipient|array|null $to = null,
    ): self {
        $obj = new self;

        null !== $brandID && $obj->brandID = $brandID;
        null !== $channels && $obj->channels = $channels;
        null !== $content && $obj->content = $content;
        null !== $context && $obj->context = $context;
        null !== $data && $obj->data = $data;
        null !== $delay && $obj->delay = $delay;
        null !== $expiry && $obj->expiry = $expiry;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $preferences && $obj->preferences = $preferences;
        null !== $providers && $obj->providers = $providers;
        null !== $routing && $obj->routing = $routing;
        null !== $template && $obj->template = $template;
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
     * Define run-time configuration for channels. Valid ChannelId's: email, sms, push, inbox, direct_message, banner, webhook.
     *
     * @param array<string, Channel>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $obj = clone $this;
        $obj->channels = $channels;

        return $obj;
    }

    /**
     * Describes content that will work for email, inbox, push, chat, or any channel id.
     */
    public function withContent(
        ElementalContentSugar|ElementalContent $content
    ): self {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }

    public function withContext(?MessageContext $context): self
    {
        $obj = clone $this;
        $obj->context = $context;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    public function withDelay(?Delay $delay): self
    {
        $obj = clone $this;
        $obj->delay = $delay;

        return $obj;
    }

    public function withExpiry(?Expiry $expiry): self
    {
        $obj = clone $this;
        $obj->expiry = $expiry;

        return $obj;
    }

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
     * @param array<string, Provider>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $obj = clone $this;
        $obj->providers = $providers;

        return $obj;
    }

    /**
     * Customize which channels/providers Courier may deliver the message through.
     */
    public function withRouting(?Routing $routing): self
    {
        $obj = clone $this;
        $obj->routing = $routing;

        return $obj;
    }

    /**
     * The id of the template you want to send.
     */
    public function withTemplate(?string $template): self
    {
        $obj = clone $this;
        $obj->template = $template;

        return $obj;
    }

    public function withTimeout(?Timeout $timeout): self
    {
        $obj = clone $this;
        $obj->timeout = $timeout;

        return $obj;
    }

    /**
     * The recipient or a list of recipients of the message.
     *
     * @param UserRecipient|list<Recipient>|null $to
     */
    public function withTo(UserRecipient|array|null $to): self
    {
        $obj = clone $this;
        $obj->to = $to;

        return $obj;
    }
}
