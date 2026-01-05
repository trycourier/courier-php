<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendToChannelShape = array{channelID: string}
 */
final class SendToChannel implements BaseModel
{
    /** @use SdkModel<SendToChannelShape> */
    use SdkModel;

    #[Required('channel_id')]
    public string $channelID;

    /**
     * `new SendToChannel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToChannel::with(channelID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToChannel)->withChannelID(...)
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
     */
    public static function with(string $channelID): self
    {
        $self = new self;

        $self['channelID'] = $channelID;

        return $self;
    }

    public function withChannelID(string $channelID): self
    {
        $self = clone $this;
        $self['channelID'] = $channelID;

        return $self;
    }
}
