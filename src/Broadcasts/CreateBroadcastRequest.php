<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Broadcasts\CreateBroadcastRequest\Channel;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for creating a broadcast.
 *
 * @phpstan-type CreateBroadcastRequestShape = array{
 *   channel: Channel|value-of<Channel>, name: string
 * }
 */
final class CreateBroadcastRequest implements BaseModel
{
    /** @use SdkModel<CreateBroadcastRequestShape> */
    use SdkModel;

    /**
     * The single delivery channel for this broadcast.
     *
     * @var value-of<Channel> $channel
     */
    #[Required(enum: Channel::class)]
    public string $channel;

    /**
     * Human-readable name.
     */
    #[Required]
    public string $name;

    /**
     * `new CreateBroadcastRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreateBroadcastRequest::with(channel: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreateBroadcastRequest)->withChannel(...)->withName(...)
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
     * @param Channel|value-of<Channel> $channel
     */
    public static function with(Channel|string $channel, string $name): self
    {
        $self = new self;

        $self['channel'] = $channel;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The single delivery channel for this broadcast.
     *
     * @param Channel|value-of<Channel> $channel
     */
    public function withChannel(Channel|string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    /**
     * Human-readable name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
