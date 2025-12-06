<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRouting\Method;

/**
 * @phpstan-type MessageRoutingShape = array{
 *   channels: list<mixed>, method: value-of<Method>
 * }
 */
final class MessageRouting implements BaseModel
{
    /** @use SdkModel<MessageRoutingShape> */
    use SdkModel;

    /** @var list<mixed> $channels */
    #[Api(list: MessageRoutingChannel::class)]
    public array $channels;

    /** @var value-of<Method> $method */
    #[Api(enum: Method::class)]
    public string $method;

    /**
     * `new MessageRouting()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageRouting::with(channels: ..., method: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageRouting)->withChannels(...)->withMethod(...)
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
     * @param list<mixed> $channels
     * @param Method|value-of<Method> $method
     */
    public static function with(array $channels, Method|string $method): self
    {
        $obj = new self;

        $obj['channels'] = $channels;
        $obj['method'] = $method;

        return $obj;
    }

    /**
     * @param list<mixed> $channels
     */
    public function withChannels(array $channels): self
    {
        $obj = clone $this;
        $obj['channels'] = $channels;

        return $obj;
    }

    /**
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $obj = clone $this;
        $obj['method'] = $method;

        return $obj;
    }
}
