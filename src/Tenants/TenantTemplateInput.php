<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent;
use Courier\MessageRouting;
use Courier\Tenants\TenantTemplateInput\Channel;
use Courier\Tenants\TenantTemplateInput\Provider;

/**
 * Template configuration for creating or updating a tenant notification template.
 *
 * @phpstan-import-type ElementalContentShape from \Courier\ElementalContent
 * @phpstan-import-type ChannelShape from \Courier\Tenants\TenantTemplateInput\Channel
 * @phpstan-import-type ProviderShape from \Courier\Tenants\TenantTemplateInput\Provider
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 *
 * @phpstan-type TenantTemplateInputShape = array{
 *   content: ElementalContent|ElementalContentShape,
 *   channels?: array<string,Channel|ChannelShape>|null,
 *   providers?: array<string,Provider|ProviderShape>|null,
 *   routing?: null|MessageRouting|MessageRoutingShape,
 * }
 */
final class TenantTemplateInput implements BaseModel
{
    /** @use SdkModel<TenantTemplateInputShape> */
    use SdkModel;

    /**
     * Template content configuration including blocks, elements, and message structure.
     */
    #[Required]
    public ElementalContent $content;

    /**
     * Channel-specific delivery configuration (email, SMS, push, etc.).
     *
     * @var array<string,Channel>|null $channels
     */
    #[Optional(map: Channel::class)]
    public ?array $channels;

    /**
     * Provider-specific delivery configuration for routing to specific email/SMS providers.
     *
     * @var array<string,Provider>|null $providers
     */
    #[Optional(map: Provider::class)]
    public ?array $providers;

    /**
     * Message routing configuration for multi-channel delivery strategies.
     */
    #[Optional]
    public ?MessageRouting $routing;

    /**
     * `new TenantTemplateInput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantTemplateInput::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenantTemplateInput)->withContent(...)
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
     * @param ElementalContent|ElementalContentShape $content
     * @param array<string,Channel|ChannelShape>|null $channels
     * @param array<string,Provider|ProviderShape>|null $providers
     * @param MessageRouting|MessageRoutingShape|null $routing
     */
    public static function with(
        ElementalContent|array $content,
        ?array $channels = null,
        ?array $providers = null,
        MessageRouting|array|null $routing = null,
    ): self {
        $self = new self;

        $self['content'] = $content;

        null !== $channels && $self['channels'] = $channels;
        null !== $providers && $self['providers'] = $providers;
        null !== $routing && $self['routing'] = $routing;

        return $self;
    }

    /**
     * Template content configuration including blocks, elements, and message structure.
     *
     * @param ElementalContent|ElementalContentShape $content
     */
    public function withContent(ElementalContent|array $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Channel-specific delivery configuration (email, SMS, push, etc.).
     *
     * @param array<string,Channel|ChannelShape> $channels
     */
    public function withChannels(array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    /**
     * Provider-specific delivery configuration for routing to specific email/SMS providers.
     *
     * @param array<string,Provider|ProviderShape> $providers
     */
    public function withProviders(array $providers): self
    {
        $self = clone $this;
        $self['providers'] = $providers;

        return $self;
    }

    /**
     * Message routing configuration for multi-channel delivery strategies.
     *
     * @param MessageRouting|MessageRoutingShape $routing
     */
    public function withRouting(MessageRouting|array $routing): self
    {
        $self = clone $this;
        $self['routing'] = $routing;

        return $self;
    }
}
