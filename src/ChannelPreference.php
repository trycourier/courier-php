<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChannelPreferenceShape = array{
 *   channel: ChannelClassification|value-of<ChannelClassification>
 * }
 */
final class ChannelPreference implements BaseModel
{
    /** @use SdkModel<ChannelPreferenceShape> */
    use SdkModel;

    /** @var value-of<ChannelClassification> $channel */
    #[Required(enum: ChannelClassification::class)]
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
     * @param ChannelClassification|value-of<ChannelClassification> $channel
     */
    public static function with(ChannelClassification|string $channel): self
    {
        $self = new self;

        $self['channel'] = $channel;

        return $self;
    }

    /**
     * @param ChannelClassification|value-of<ChannelClassification> $channel
     */
    public function withChannel(ChannelClassification|string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }
}
