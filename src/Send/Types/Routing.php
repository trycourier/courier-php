<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Core\Types\Union;

/**
 * Allows you to customize which channel(s) Courier will potentially deliver the message.
 * If no routing key is specified, Courier will use the default routing configuration or
 * routing defined by the template.
 */
class Routing extends JsonSerializableType
{
    /**
     * @var value-of<RoutingMethod> $method
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var array<RoutingStrategyChannel|RoutingStrategyProvider|string> $channels A list of channels or providers to send the message through. Can also recursively define
    sub-routing methods, which can be useful for defining advanced push notification
    delivery strategies.
     */
    #[JsonProperty('channels'), ArrayType([new Union(RoutingStrategyChannel::class, RoutingStrategyProvider::class, 'string')])]
    public array $channels;

    /**
     * @param array{
     *   method: value-of<RoutingMethod>,
     *   channels: array<RoutingStrategyChannel|RoutingStrategyProvider|string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->channels = $values['channels'];
    }
}
