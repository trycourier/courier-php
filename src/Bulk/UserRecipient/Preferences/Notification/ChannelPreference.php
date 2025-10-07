<?php

declare(strict_types=1);

namespace Courier\Bulk\UserRecipient\Preferences\Notification;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\DefaultPreferences\Items\ChannelClassification;

/**
 * @phpstan-type channel_preference = array{
 *   channel: value-of<ChannelClassification>
 * }
 */
final class ChannelPreference implements BaseModel
{
    /** @use SdkModel<channel_preference> */
    use SdkModel;

    /** @var value-of<ChannelClassification> $channel */
    #[Api(enum: ChannelClassification::class)]
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
        $obj = new self;

        $obj['channel'] = $channel;

        return $obj;
    }

    /**
     * @param ChannelClassification|value-of<ChannelClassification> $channel
     */
    public function withChannel(ChannelClassification|string $channel): self
    {
        $obj = clone $this;
        $obj['channel'] = $channel;

        return $obj;
    }
}
