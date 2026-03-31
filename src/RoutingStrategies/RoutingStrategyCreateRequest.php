<?php

declare(strict_types=1);

namespace Courier\RoutingStrategies;

use Courier\Channel;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageProvidersType;
use Courier\MessageRouting;

/**
 * Request body for creating a routing strategy.
 *
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 * @phpstan-import-type ChannelShape from \Courier\Channel
 * @phpstan-import-type MessageProvidersTypeShape from \Courier\MessageProvidersType
 *
 * @phpstan-type RoutingStrategyCreateRequestShape = array{
 *   name: string,
 *   routing: MessageRouting|MessageRoutingShape,
 *   channels?: array<string,Channel|ChannelShape>|null,
 *   description?: string|null,
 *   providers?: array<string,MessageProvidersType|MessageProvidersTypeShape>|null,
 *   tags?: list<string>|null,
 * }
 */
final class RoutingStrategyCreateRequest implements BaseModel
{
    /** @use SdkModel<RoutingStrategyCreateRequestShape> */
    use SdkModel;

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
     * Per-channel delivery configuration. Defaults to empty if omitted.
     *
     * @var array<string,Channel>|null $channels
     */
    #[Optional(map: Channel::class, nullable: true)]
    public ?array $channels;

    /**
     * Optional description of the routing strategy.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Per-provider delivery configuration. Defaults to empty if omitted.
     *
     * @var array<string,MessageProvidersType>|null $providers
     */
    #[Optional(map: MessageProvidersType::class, nullable: true)]
    public ?array $providers;

    /**
     * Optional tags for categorization.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $tags;

    /**
     * `new RoutingStrategyCreateRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingStrategyCreateRequest::with(name: ..., routing: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingStrategyCreateRequest)->withName(...)->withRouting(...)
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
     * Per-channel delivery configuration. Defaults to empty if omitted.
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
     * Optional description of the routing strategy.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Per-provider delivery configuration. Defaults to empty if omitted.
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
     * Optional tags for categorization.
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
