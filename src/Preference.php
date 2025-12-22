<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Preference\Source;

/**
 * @phpstan-import-type ChannelPreferenceShape from \Courier\ChannelPreference
 * @phpstan-import-type RuleShape from \Courier\Rule
 *
 * @phpstan-type PreferenceShape = array{
 *   status: PreferenceStatus|value-of<PreferenceStatus>,
 *   channelPreferences?: list<ChannelPreferenceShape>|null,
 *   rules?: list<RuleShape>|null,
 *   source?: null|Source|value-of<Source>,
 * }
 */
final class Preference implements BaseModel
{
    /** @use SdkModel<PreferenceShape> */
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

    /** @var value-of<Source>|null $source */
    #[Optional(enum: Source::class, nullable: true)]
    public ?string $source;

    /**
     * `new Preference()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Preference::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Preference)->withStatus(...)
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
     * @param list<ChannelPreferenceShape>|null $channelPreferences
     * @param list<RuleShape>|null $rules
     * @param Source|value-of<Source>|null $source
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $channelPreferences = null,
        ?array $rules = null,
        Source|string|null $source = null,
    ): self {
        $self = new self;

        $self['status'] = $status;

        null !== $channelPreferences && $self['channelPreferences'] = $channelPreferences;
        null !== $rules && $self['rules'] = $rules;
        null !== $source && $self['source'] = $source;

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
     * @param list<ChannelPreferenceShape>|null $channelPreferences
     */
    public function withChannelPreferences(?array $channelPreferences): self
    {
        $self = clone $this;
        $self['channelPreferences'] = $channelPreferences;

        return $self;
    }

    /**
     * @param list<RuleShape>|null $rules
     */
    public function withRules(?array $rules): self
    {
        $self = clone $this;
        $self['rules'] = $rules;

        return $self;
    }

    /**
     * @param Source|value-of<Source>|null $source
     */
    public function withSource(Source|string|null $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
