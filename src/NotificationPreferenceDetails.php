<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ChannelPreferenceShape from \Courier\ChannelPreference
 * @phpstan-import-type RuleShape from \Courier\Rule
 *
 * @phpstan-type NotificationPreferenceDetailsShape = array{
 *   status: PreferenceStatus|value-of<PreferenceStatus>,
 *   channelPreferences?: list<ChannelPreference|ChannelPreferenceShape>|null,
 *   rules?: list<Rule|RuleShape>|null,
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
     * @param list<ChannelPreference|ChannelPreferenceShape>|null $channelPreferences
     * @param list<Rule|RuleShape>|null $rules
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $channelPreferences = null,
        ?array $rules = null,
    ): self {
        $self = new self;

        $self['status'] = $status;

        null !== $channelPreferences && $self['channelPreferences'] = $channelPreferences;
        null !== $rules && $self['rules'] = $rules;

        return $self;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param list<ChannelPreference|ChannelPreferenceShape>|null $channelPreferences
     */
    public function withChannelPreferences(?array $channelPreferences): self
    {
        $self = clone $this;
        $self['channelPreferences'] = $channelPreferences;

        return $self;
    }

    /**
     * @param list<Rule|RuleShape>|null $rules
     */
    public function withRules(?array $rules): self
    {
        $self = clone $this;
        $self['rules'] = $rules;

        return $self;
    }
}
