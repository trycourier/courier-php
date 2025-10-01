<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessage\Routing\Channel;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyChannel;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyProvider;
use Courier\Send\RoutingMethod;

/**
 * Allows you to customize which channel(s) Courier will potentially deliver the message.
 * If no routing key is specified, Courier will use the default routing configuration or
 * routing defined by the template.
 *
 * @phpstan-type routing_alias = array{
 *   channels: list<string|RoutingStrategyChannel|RoutingStrategyProvider>,
 *   method: value-of<RoutingMethod>,
 * }
 */
final class Routing implements BaseModel
{
    /** @use SdkModel<routing_alias> */
    use SdkModel;

    /**
     * A list of channels or providers to send the message through. Can also recursively define
     * sub-routing methods, which can be useful for defining advanced push notification
     * delivery strategies.
     *
     * @var list<string|RoutingStrategyChannel|RoutingStrategyProvider> $channels
     */
    #[Api(list: Channel::class)]
    public array $channels;

    /** @var value-of<RoutingMethod> $method */
    #[Api(enum: RoutingMethod::class)]
    public string $method;

    /**
     * `new Routing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Routing::with(channels: ..., method: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Routing)->withChannels(...)->withMethod(...)
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
     * @param list<string|RoutingStrategyChannel|RoutingStrategyProvider> $channels
     * @param RoutingMethod|value-of<RoutingMethod> $method
     */
    public static function with(
        array $channels,
        RoutingMethod|string $method
    ): self {
        $obj = new self;

        $obj->channels = $channels;
        $obj->method = $method instanceof RoutingMethod ? $method->value : $method;

        return $obj;
    }

    /**
     * A list of channels or providers to send the message through. Can also recursively define
     * sub-routing methods, which can be useful for defining advanced push notification
     * delivery strategies.
     *
     * @param list<string|RoutingStrategyChannel|RoutingStrategyProvider> $channels
     */
    public function withChannels(array $channels): self
    {
        $obj = clone $this;
        $obj->channels = $channels;

        return $obj;
    }

    /**
     * @param RoutingMethod|value-of<RoutingMethod> $method
     */
    public function withMethod(RoutingMethod|string $method): self
    {
        $obj = clone $this;
        $obj->method = $method instanceof RoutingMethod ? $method->value : $method;

        return $obj;
    }
}
