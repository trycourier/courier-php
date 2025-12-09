<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type NotificationPreferenceDetailsShape = array{
 *   status: value-of<PreferenceStatus>,
 *   channelPreferences?: list<ChannelPreference>|null,
 *   rules?: list<Rule>|null,
 * }
 */
final class NotificationPreferenceDetails implements BaseModel
{
    /** @use SdkModel<NotificationPreferenceDetailsShape> */
    use SdkModel;

    /** @var value-of<PreferenceStatus> $status */
    #[Required(enum: PreferenceStatus::class)]
    public string $status;

    /** @var list<ChannelPreference>|null $channelPreferences */
    #[Optional(
        'channel_preferences',
        list: ChannelPreference::class,
        nullable: true
    )]
    public ?array $channelPreferences;

    /** @var list<Rule>|null $rules */
    #[Optional(list: Rule::class, nullable: true)]
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
     * @param list<ChannelPreference|array{
     *   channel: value-of<ChannelClassification>
     * }>|null $channelPreferences
     * @param list<Rule|array{until: string, start?: string|null}>|null $rules
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $channelPreferences = null,
        ?array $rules = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;

        null !== $channelPreferences && $obj['channelPreferences'] = $channelPreferences;
        null !== $rules && $obj['rules'] = $rules;

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
     * @param list<ChannelPreference|array{
     *   channel: value-of<ChannelClassification>
     * }>|null $channelPreferences
     */
    public function withChannelPreferences(?array $channelPreferences): self
    {
        $obj = clone $this;
        $obj['channelPreferences'] = $channelPreferences;

        return $obj;
    }

    /**
     * @param list<Rule|array{until: string, start?: string|null}>|null $rules
     */
    public function withRules(?array $rules): self
    {
        $obj = clone $this;
        $obj['rules'] = $rules;

        return $obj;
    }
}
