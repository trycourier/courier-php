<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRoutingChannel;
use Courier\Send\SendMessageParams\Message\Routing\Method;

/**
 * Customize which channels/providers Courier may deliver the message through.
 *
 * @phpstan-type RoutingShape = array{
 *   channels: list<mixed>, method: Method|value-of<Method>
 * }
 */
final class Routing implements BaseModel
{
    /** @use SdkModel<RoutingShape> */
    use SdkModel;

    /**
     * A list of channels or providers (or nested routing rules).
     *
     * @var list<mixed> $channels
     */
    #[Required(list: MessageRoutingChannel::class)]
    public array $channels;

    /** @var value-of<Method> $method */
    #[Required(enum: Method::class)]
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
     * A list of channels or providers (or nested routing rules).
     *
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
