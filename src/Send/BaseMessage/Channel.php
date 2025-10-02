<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessage\Channel\Metadata;
use Courier\Send\BaseMessage\Channel\RoutingMethod;
use Courier\Send\BaseMessage\Channel\Timeouts;

/**
 * @phpstan-type channel_alias = array{
 *   brandID?: string|null,
 *   if?: string|null,
 *   metadata?: Metadata|null,
 *   override?: array<string, mixed>|null,
 *   providers?: list<string>|null,
 *   routingMethod?: value-of<RoutingMethod>|null,
 *   timeouts?: Timeouts|null,
 * }
 */
final class Channel implements BaseModel
{
    /** @use SdkModel<channel_alias> */
    use SdkModel;

    /**
     * Id of the brand that should be used for rendering the message.
     * If not specified, the brand configured as default brand will be used.
     */
    #[Api('brand_id', nullable: true, optional: true)]
    public ?string $brandID;

    /**
     * A JavaScript conditional expression to determine if the message should  be sent through the channel. Has access to the data and profile object.
     * Only applies when a custom routing strategy is defined.
     * For example, `data.name === profile.name`.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?Metadata $metadata;

    /**
     * Channel specific overrides.
     *
     * @var array<string, mixed>|null $override
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $override;

    /**
     * A list of providers enabled for this channel. Courier will select
     * one provider to send through unless routing_method is set to all.
     *
     * @var list<string>|null $providers
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $providers;

    /**
     * The method for selecting the providers to send the message with.
     * Single will send to one of the available providers for this channel,
     * all will send the message through all channels. Defaults to `single`.
     *
     * @var value-of<RoutingMethod>|null $routingMethod
     */
    #[Api(
        'routing_method',
        enum: RoutingMethod::class,
        nullable: true,
        optional: true
    )]
    public ?string $routingMethod;

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
     * @param array<string, mixed>|null $override
     * @param list<string>|null $providers
     * @param RoutingMethod|value-of<RoutingMethod>|null $routingMethod
     */
    public static function with(
        ?string $brandID = null,
        ?string $if = null,
        ?Metadata $metadata = null,
        ?array $override = null,
        ?array $providers = null,
        RoutingMethod|string|null $routingMethod = null,
        ?Timeouts $timeouts = null,
    ): self {
        $obj = new self;

        null !== $brandID && $obj->brandID = $brandID;
        null !== $if && $obj->if = $if;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $override && $obj->override = $override;
        null !== $providers && $obj->providers = $providers;
        null !== $routingMethod && $obj->routingMethod = $routingMethod instanceof RoutingMethod ? $routingMethod->value : $routingMethod;
        null !== $timeouts && $obj->timeouts = $timeouts;

        return $obj;
    }

    /**
     * Id of the brand that should be used for rendering the message.
     * If not specified, the brand configured as default brand will be used.
     */
    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj->brandID = $brandID;

        return $obj;
    }

    /**
     * A JavaScript conditional expression to determine if the message should  be sent through the channel. Has access to the data and profile object.
     * Only applies when a custom routing strategy is defined.
     * For example, `data.name === profile.name`.
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
     * @param array<string, mixed>|null $override
     */
    public function withOverride(?array $override): self
    {
        $obj = clone $this;
        $obj->override = $override;

        return $obj;
    }

    /**
     * A list of providers enabled for this channel. Courier will select
     * one provider to send through unless routing_method is set to all.
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
     * The method for selecting the providers to send the message with.
     * Single will send to one of the available providers for this channel,
     * all will send the message through all channels. Defaults to `single`.
     *
     * @param RoutingMethod|value-of<RoutingMethod>|null $routingMethod
     */
    public function withRoutingMethod(
        RoutingMethod|string|null $routingMethod
    ): self {
        $obj = clone $this;
        $obj->routingMethod = $routingMethod instanceof RoutingMethod ? $routingMethod->value : $routingMethod;

        return $obj;
    }

    public function withTimeouts(?Timeouts $timeouts): self
    {
        $obj = clone $this;
        $obj->timeouts = $timeouts;

        return $obj;
    }
}
