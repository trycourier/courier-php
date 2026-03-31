<?php

declare(strict_types=1);

namespace Courier\RoutingStrategies;

use Courier\Channel;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageProvidersType;
use Courier\MessageRouting;

/**
 * Replace a routing strategy. Full document replacement; the caller must send the complete desired state. Missing optional fields are cleared.
 *
 * @see Courier\Services\RoutingStrategiesService::replace()
 *
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 * @phpstan-import-type ChannelShape from \Courier\Channel
 * @phpstan-import-type MessageProvidersTypeShape from \Courier\MessageProvidersType
 *
 * @phpstan-type RoutingStrategyReplaceParamsShape = array{
 *   name: string,
 *   routing: MessageRouting|MessageRoutingShape,
 *   channels?: array<string,Channel|ChannelShape>|null,
 *   description?: string|null,
 *   providers?: array<string,MessageProvidersType|MessageProvidersTypeShape>|null,
 *   tags?: list<string>|null,
 * }
 */
final class RoutingStrategyReplaceParams implements BaseModel
{
    /** @use SdkModel<RoutingStrategyReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Human-readable name for the routing strategy.
     */
    #[Required]
    public string $name;

    /**
     * Routing tree defining channel selection method and order.
     */
    #[Required]
    public MessageRouting $routing;

    /**
     * Per-channel delivery configuration. Omit to clear.
     *
     * @var array<string,Channel>|null $channels
     */
    #[Optional(map: Channel::class, nullable: true)]
    public ?array $channels;

    /**
     * Optional description. Omit or null to clear.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Per-provider delivery configuration. Omit to clear.
     *
     * @var array<string,MessageProvidersType>|null $providers
     */
    #[Optional(map: MessageProvidersType::class, nullable: true)]
    public ?array $providers;

    /**
     * Optional tags. Omit or null to clear.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $tags;

    /**
     * `new RoutingStrategyReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingStrategyReplaceParams::with(name: ..., routing: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingStrategyReplaceParams)->withName(...)->withRouting(...)
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
     * @param MessageRouting|MessageRoutingShape $routing
     * @param array<string,Channel|ChannelShape>|null $channels
     * @param array<string,MessageProvidersType|MessageProvidersTypeShape>|null $providers
     * @param list<string>|null $tags
     */
    public static function with(
        string $name,
        MessageRouting|array $routing,
        ?array $channels = null,
        ?string $description = null,
        ?array $providers = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['routing'] = $routing;

        null !== $channels && $self['channels'] = $channels;
        null !== $description && $self['description'] = $description;
        null !== $providers && $self['providers'] = $providers;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * Human-readable name for the routing strategy.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Routing tree defining channel selection method and order.
     *
     * @param MessageRouting|MessageRoutingShape $routing
     */
    public function withRouting(MessageRouting|array $routing): self
    {
        $self = clone $this;
        $self['routing'] = $routing;

        return $self;
    }

    /**
     * Per-channel delivery configuration. Omit to clear.
     *
     * @param array<string,Channel|ChannelShape>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    /**
     * Optional description. Omit or null to clear.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Per-provider delivery configuration. Omit to clear.
     *
     * @param array<string,MessageProvidersType|MessageProvidersTypeShape>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $self = clone $this;
        $self['providers'] = $providers;

        return $self;
    }

    /**
     * Optional tags. Omit or null to clear.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
