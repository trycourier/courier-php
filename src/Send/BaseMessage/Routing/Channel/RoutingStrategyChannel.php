<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage\Routing\Channel;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyChannel\Provider;
use Courier\Send\RoutingMethod;

/**
 * @phpstan-type routing_strategy_channel = array{
 *   channel: string,
 *   config?: array<string, mixed>|null,
 *   if?: string|null,
 *   method?: value-of<RoutingMethod>|null,
 *   providers?: array<string, Provider>|null,
 * }
 */
final class RoutingStrategyChannel implements BaseModel
{
    /** @use SdkModel<routing_strategy_channel> */
    use SdkModel;

    #[Api]
    public string $channel;

    /** @var array<string, mixed>|null $config */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $config;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    /** @var value-of<RoutingMethod>|null $method */
    #[Api(enum: RoutingMethod::class, nullable: true, optional: true)]
    public ?string $method;

    /** @var array<string, Provider>|null $providers */
    #[Api(map: Provider::class, nullable: true, optional: true)]
    public ?array $providers;

    /**
     * `new RoutingStrategyChannel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingStrategyChannel::with(channel: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingStrategyChannel)->withChannel(...)
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
     * @param array<string, mixed>|null $config
     * @param RoutingMethod|value-of<RoutingMethod>|null $method
     * @param array<string, Provider>|null $providers
     */
    public static function with(
        string $channel,
        ?array $config = null,
        ?string $if = null,
        RoutingMethod|string|null $method = null,
        ?array $providers = null,
    ): self {
        $obj = new self;

        $obj->channel = $channel;

        null !== $config && $obj->config = $config;
        null !== $if && $obj->if = $if;
        null !== $method && $obj->method = $method instanceof RoutingMethod ? $method->value : $method;
        null !== $providers && $obj->providers = $providers;

        return $obj;
    }

    public function withChannel(string $channel): self
    {
        $obj = clone $this;
        $obj->channel = $channel;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $config
     */
    public function withConfig(?array $config): self
    {
        $obj = clone $this;
        $obj->config = $config;

        return $obj;
    }

    public function withIf(?string $if): self
    {
        $obj = clone $this;
        $obj->if = $if;

        return $obj;
    }

    /**
     * @param RoutingMethod|value-of<RoutingMethod>|null $method
     */
    public function withMethod(RoutingMethod|string|null $method): self
    {
        $obj = clone $this;
        $obj->method = $method instanceof RoutingMethod ? $method->value : $method;

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
}
