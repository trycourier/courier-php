<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendMessageParams\Message\Channel\Metadata;
use Courier\Send\SendMessageParams\Message\Channel\RoutingMethod;
use Courier\Send\SendMessageParams\Message\Channel\Timeouts;

/**
 * @phpstan-type ChannelShape = array{
 *   brand_id?: string|null,
 *   if?: string|null,
 *   metadata?: Metadata|null,
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
    #[Api(nullable: true, optional: true)]
    public ?string $brand_id;

    /**
     * JS conditional with access to data/profile.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?Metadata $metadata;

    /**
     * Channel specific overrides.
     *
     * @var array<string,mixed>|null $override
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $override;

    /**
     * Providers enabled for this channel.
     *
     * @var list<string>|null $providers
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $providers;

    /**
     * Defaults to `single`.
     *
     * @var value-of<RoutingMethod>|null $routing_method
     */
    #[Api(enum: RoutingMethod::class, nullable: true, optional: true)]
    public ?string $routing_method;

    #[Api(nullable: true, optional: true)]
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
     * @param array<string,mixed>|null $override
     * @param list<string>|null $providers
     * @param RoutingMethod|value-of<RoutingMethod>|null $routing_method
     */
    public static function with(
        ?string $brand_id = null,
        ?string $if = null,
        ?Metadata $metadata = null,
        ?array $override = null,
        ?array $providers = null,
        RoutingMethod|string|null $routing_method = null,
        ?Timeouts $timeouts = null,
    ): self {
        $obj = new self;

        null !== $brand_id && $obj->brand_id = $brand_id;
        null !== $if && $obj->if = $if;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $override && $obj->override = $override;
        null !== $providers && $obj->providers = $providers;
        null !== $routing_method && $obj['routing_method'] = $routing_method;
        null !== $timeouts && $obj->timeouts = $timeouts;

        return $obj;
    }

    /**
     * Brand id used for rendering.
     */
    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj->brand_id = $brandID;

        return $obj;
    }

    /**
     * JS conditional with access to data/profile.
     */
    public function withIf(?string $if): self
    {
        $obj = clone $this;
        $obj->if = $if;

        return $obj;
    }

    public function withMetadata(?Metadata $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

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
        $obj->override = $override;

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
        $obj->providers = $providers;

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

    public function withTimeouts(?Timeouts $timeouts): self
    {
        $obj = clone $this;
        $obj->timeouts = $timeouts;

        return $obj;
    }
}
