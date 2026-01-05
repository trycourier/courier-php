<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendMessageParams\Message\Channel\Metadata;
use Courier\Send\SendMessageParams\Message\Channel\RoutingMethod;
use Courier\Send\SendMessageParams\Message\Channel\Timeouts;

/**
 * @phpstan-import-type MetadataShape from \Courier\Send\SendMessageParams\Message\Channel\Metadata
 * @phpstan-import-type TimeoutsShape from \Courier\Send\SendMessageParams\Message\Channel\Timeouts
 *
 * @phpstan-type ChannelShape = array{
 *   brandID?: string|null,
 *   if?: string|null,
 *   metadata?: null|\Courier\Send\SendMessageParams\Message\Channel\Metadata|MetadataShape,
 *   override?: array<string,mixed>|null,
 *   providers?: list<string>|null,
 *   routingMethod?: null|RoutingMethod|value-of<RoutingMethod>,
 *   timeouts?: null|Timeouts|TimeoutsShape,
 * }
 */
final class Channel implements BaseModel
{
    /** @use SdkModel<ChannelShape> */
    use SdkModel;

    /**
     * Brand id used for rendering.
     */
    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * JS conditional with access to data/profile.
     */
    #[Optional(nullable: true)]
    public ?string $if;

    #[Optional(nullable: true)]
    public ?Metadata $metadata;

    /**
     * Channel specific overrides.
     *
     * @var array<string,mixed>|null $override
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $override;

    /**
     * Providers enabled for this channel.
     *
     * @var list<string>|null $providers
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $providers;

    /**
     * Defaults to `single`.
     *
     * @var value-of<RoutingMethod>|null $routingMethod
     */
    #[Optional('routing_method', enum: RoutingMethod::class, nullable: true)]
    public ?string $routingMethod;

    #[Optional(nullable: true)]
    public ?Timeouts $timeouts;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Metadata|MetadataShape|null $metadata
     * @param array<string,mixed>|null $override
     * @param list<string>|null $providers
     * @param RoutingMethod|value-of<RoutingMethod>|null $routingMethod
     * @param Timeouts|TimeoutsShape|null $timeouts
     */
    public static function with(
        ?string $brandID = null,
        ?string $if = null,
        Metadata|array|null $metadata = null,
        ?array $override = null,
        ?array $providers = null,
        RoutingMethod|string|null $routingMethod = null,
        Timeouts|array|null $timeouts = null,
    ): self {
        $self = new self;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $if && $self['if'] = $if;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $override && $self['override'] = $override;
        null !== $providers && $self['providers'] = $providers;
        null !== $routingMethod && $self['routingMethod'] = $routingMethod;
        null !== $timeouts && $self['timeouts'] = $timeouts;

        return $self;
    }

    /**
     * Brand id used for rendering.
     */
    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * JS conditional with access to data/profile.
     */
    public function withIf(?string $if): self
    {
        $self = clone $this;
        $self['if'] = $if;

        return $self;
    }

    /**
     * @param Metadata|MetadataShape|null $metadata
     */
    public function withMetadata(
        Metadata|array|null $metadata,
    ): self {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Channel specific overrides.
     *
     * @param array<string,mixed>|null $override
     */
    public function withOverride(?array $override): self
    {
        $self = clone $this;
        $self['override'] = $override;

        return $self;
    }

    /**
     * Providers enabled for this channel.
     *
     * @param list<string>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $self = clone $this;
        $self['providers'] = $providers;

        return $self;
    }

    /**
     * Defaults to `single`.
     *
     * @param RoutingMethod|value-of<RoutingMethod>|null $routingMethod
     */
    public function withRoutingMethod(
        RoutingMethod|string|null $routingMethod
    ): self {
        $self = clone $this;
        $self['routingMethod'] = $routingMethod;

        return $self;
    }

    /**
     * @param Timeouts|TimeoutsShape|null $timeouts
     */
    public function withTimeouts(Timeouts|array|null $timeouts): self
    {
        $self = clone $this;
        $self['timeouts'] = $timeouts;

        return $self;
    }
}
