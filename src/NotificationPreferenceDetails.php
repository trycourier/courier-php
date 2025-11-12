<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type NotificationPreferenceDetailsShape = array{
 *   status: value-of<PreferenceStatus>,
 *   channel_preferences?: list<ChannelPreference>|null,
 *   rules?: list<Rule>|null,
 * }
 */
final class NotificationPreferenceDetails implements BaseModel
{
    /** @use SdkModel<NotificationPreferenceDetailsShape> */
    use SdkModel;

    /** @var value-of<PreferenceStatus> $status */
    #[Api(enum: PreferenceStatus::class)]
    public string $status;

    /** @var list<ChannelPreference>|null $channel_preferences */
    #[Api(list: ChannelPreference::class, nullable: true, optional: true)]
    public ?array $channel_preferences;

    /** @var list<Rule>|null $rules */
    #[Api(list: Rule::class, nullable: true, optional: true)]
    public ?array $rules;

    /**
     * `new NotificationPreferenceDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPreferenceDetails::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPreferenceDetails)->withStatus(...)
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
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     * @param list<ChannelPreference>|null $channel_preferences
     * @param list<Rule>|null $rules
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $channel_preferences = null,
        ?array $rules = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;

        null !== $channel_preferences && $obj->channel_preferences = $channel_preferences;
        null !== $rules && $obj->rules = $rules;

        return $obj;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * @param list<ChannelPreference>|null $channelPreferences
     */
    public function withChannelPreferences(?array $channelPreferences): self
    {
        $obj = clone $this;
        $obj->channel_preferences = $channelPreferences;

        return $obj;
    }

    /**
     * @param list<Rule>|null $rules
     */
    public function withRules(?array $rules): self
    {
        $obj = clone $this;
        $obj->rules = $rules;

        return $obj;
    }
}
