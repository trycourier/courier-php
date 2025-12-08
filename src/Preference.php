<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Preference\Source;

/**
 * @phpstan-type PreferenceShape = array{
 *   status: value-of<PreferenceStatus>,
 *   channel_preferences?: list<ChannelPreference>|null,
 *   rules?: list<Rule>|null,
 *   source?: value-of<Source>|null,
 * }
 */
final class Preference implements BaseModel
{
    /** @use SdkModel<PreferenceShape> */
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

    /** @var value-of<Source>|null $source */
    #[Api(enum: Source::class, nullable: true, optional: true)]
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
     * @param list<ChannelPreference|array{
     *   channel: value-of<ChannelClassification>
     * }>|null $channel_preferences
     * @param list<Rule|array{until: string, start?: string|null}>|null $rules
     * @param Source|value-of<Source>|null $source
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $channel_preferences = null,
        ?array $rules = null,
        Source|string|null $source = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;

        null !== $channel_preferences && $obj['channel_preferences'] = $channel_preferences;
        null !== $rules && $obj['rules'] = $rules;
        null !== $source && $obj['source'] = $source;

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
        $obj['channel_preferences'] = $channelPreferences;

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

    /**
     * @param Source|value-of<Source>|null $source
     */
    public function withSource(Source|string|null $source): self
    {
        $obj = clone $this;
        $obj['source'] = $source;

        return $obj;
    }
}
