<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRouting\Method;

/**
 * @phpstan-type MessageRoutingShape = array{
 *   channels: list<mixed>, method: Method|value-of<Method>
 * }
 */
final class MessageRouting implements BaseModel
{
    /** @use SdkModel<MessageRoutingShape> */
    use SdkModel;

    /** @var list<mixed> $channels */
    #[Required(list: MessageRoutingChannel::class)]
    public array $channels;

    /** @var value-of<Method> $method */
    #[Required(enum: Method::class)]
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
        $self = new self;

        $self['channels'] = $channels;
        $self['method'] = $method;

        return $self;
    }

    /**
     * @param list<mixed> $channels
     */
    public function withChannels(array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    /**
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }
}
