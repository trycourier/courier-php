<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\MessageRouting;
use Courier\Notifications\MessageRoutingChannel;
use Courier\Send\BaseMessage\Routing\Method;

/**
 * Allows you to customize which channel(s) Courier will potentially deliver the message.
 * If no routing key is specified, Courier will use the default routing configuration or
 * routing defined by the template.
 *
 * @phpstan-type routing_alias = array{
 *   channels: list<string|MessageRouting>, method: value-of<Method>
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
     * @var list<string|MessageRouting> $channels
     */
    #[Api(list: MessageRoutingChannel::class)]
    public array $channels;

    /** @var value-of<Method> $method */
    #[Api(enum: Method::class)]
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
     * @param list<string|MessageRouting> $channels
     * @param Method|value-of<Method> $method
     */
    public static function with(array $channels, Method|string $method): self
    {
        $obj = new self;

        $obj->channels = $channels;
        $obj->method = $method instanceof Method ? $method->value : $method;

        return $obj;
    }

    /**
     * A list of channels or providers to send the message through. Can also recursively define
     * sub-routing methods, which can be useful for defining advanced push notification
     * delivery strategies.
     *
     * @param list<string|MessageRouting> $channels
     */
    public function withChannels(array $channels): self
    {
        $obj = clone $this;
        $obj->channels = $channels;

        return $obj;
    }

    /**
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $obj = clone $this;
        $obj->method = $method instanceof Method ? $method->value : $method;

        return $obj;
    }
}
