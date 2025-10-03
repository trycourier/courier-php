<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Notification;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Notification\ChannelPreference\Channel;

/**
 * @phpstan-type channel_preference = array{channel: value-of<Channel>}
 */
final class ChannelPreference implements BaseModel
{
    /** @use SdkModel<channel_preference> */
    use SdkModel;

    /** @var value-of<Channel> $channel */
    #[Api(enum: Channel::class)]
    public string $channel;

    /**
     * `new ChannelPreference()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChannelPreference::with(channel: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChannelPreference)->withChannel(...)
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
    public static function with(Channel|string $channel): self
    {
        $obj = new self;

        $obj->channel = $channel instanceof Channel ? $channel->value : $channel;

        return $obj;
    }

    /**
     * @param Channel|value-of<Channel> $channel
     */
    public function withChannel(Channel|string $channel): self
    {
        $obj = clone $this;
        $obj->channel = $channel instanceof Channel ? $channel->value : $channel;

        return $obj;
    }
}
