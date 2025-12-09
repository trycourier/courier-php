<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendMessageParams\Message\Channel\Metadata;
use Courier\Send\SendMessageParams\Message\Channel\RoutingMethod;
use Courier\Send\SendMessageParams\Message\Channel\Timeouts;
use Courier\Utm;

/**
 * @phpstan-type ChannelShape = array{
 *   brand_id?: string|null,
 *   if?: string|null,
 *   metadata?: \Courier\Send\SendMessageParams\Message\Channel\Metadata|null,
 *   override?: array<string,mixed>|null,
 *   providers?: list<string>|null,
 *   routing_method?: value-of<RoutingMethod>|null,
 *   timeouts?: Timeouts|null,
 * }
 */
final class Channel implements BaseModel
{
    /** @use SdkModel<ChannelShape> */
    use SdkModel;

    /**
     * Brand id used for rendering.
     */
    #[Optional(nullable: true)]
    public ?string $brand_id;

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
     * @var value-of<RoutingMethod>|null $routing_method
     */
    #[Optional(enum: RoutingMethod::class, nullable: true)]
    public ?string $routing_method;

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
     * @param Metadata|array{
     *   utm?: Utm|null
     * }|null $metadata
     * @param array<string,mixed>|null $override
     * @param list<string>|null $providers
     * @param RoutingMethod|value-of<RoutingMethod>|null $routing_method
     * @param Timeouts|array{channel?: int|null, provider?: int|null}|null $timeouts
     */
    public static function with(
        ?string $brand_id = null,
        ?string $if = null,
        Metadata|array|null $metadata = null,
        ?array $override = null,
        ?array $providers = null,
        RoutingMethod|string|null $routing_method = null,
        Timeouts|array|null $timeouts = null,
    ): self {
        $obj = new self;

        null !== $brand_id && $obj['brand_id'] = $brand_id;
        null !== $if && $obj['if'] = $if;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $override && $obj['override'] = $override;
        null !== $providers && $obj['providers'] = $providers;
        null !== $routing_method && $obj['routing_method'] = $routing_method;
        null !== $timeouts && $obj['timeouts'] = $timeouts;

        return $obj;
    }

    /**
     * Brand id used for rendering.
     */
    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    /**
     * JS conditional with access to data/profile.
     */
    public function withIf(?string $if): self
    {
        $obj = clone $this;
        $obj['if'] = $if;

        return $obj;
    }

    /**
     * @param Metadata|array{
     *   utm?: Utm|null
     * }|null $metadata
     */
    public function withMetadata(
        Metadata|array|null $metadata,
    ): self {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Channel specific overrides.
     *
     * @param array<string,mixed>|null $override
     */
    public function withOverride(?array $override): self
    {
        $obj = clone $this;
        $obj['override'] = $override;

        return $obj;
    }

    /**
     * Providers enabled for this channel.
     *
     * @param list<string>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $obj = clone $this;
        $obj['providers'] = $providers;

        return $obj;
    }

    /**
     * Defaults to `single`.
     *
     * @param RoutingMethod|value-of<RoutingMethod>|null $routingMethod
     */
    public function withRoutingMethod(
        RoutingMethod|string|null $routingMethod
    ): self {
        $obj = clone $this;
        $obj['routing_method'] = $routingMethod;

        return $obj;
    }

    /**
     * @param Timeouts|array{channel?: int|null, provider?: int|null}|null $timeouts
     */
    public function withTimeouts(Timeouts|array|null $timeouts): self
    {
        $obj = clone $this;
        $obj['timeouts'] = $timeouts;

        return $obj;
    }
}
