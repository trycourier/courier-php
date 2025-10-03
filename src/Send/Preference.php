<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Preference\ChannelPreference;
use Courier\Send\Preference\Rule;
use Courier\Send\Preference\Source;
use Courier\Send\Preference\Status;

/**
 * @phpstan-type preference_alias = array{
 *   status: value-of<Status>,
 *   channelPreferences?: list<ChannelPreference>|null,
 *   rules?: list<Rule>|null,
 *   source?: value-of<Source>|null,
 * }
 */
final class Preference implements BaseModel
{
    /** @use SdkModel<preference_alias> */
    use SdkModel;

    /** @var value-of<Status> $status */
    #[Api(enum: Status::class)]
    public string $status;

    /** @var list<ChannelPreference>|null $channelPreferences */
    #[Api(
        'channel_preferences',
        list: ChannelPreference::class,
        nullable: true,
        optional: true,
    )]
    public ?array $channelPreferences;

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
     * @param Status|value-of<Status> $status
     * @param list<ChannelPreference>|null $channelPreferences
     * @param list<Rule>|null $rules
     * @param Source|value-of<Source>|null $source
     */
    public static function with(
        Status|string $status,
        ?array $channelPreferences = null,
        ?array $rules = null,
        Source|string|null $source = null,
    ): self {
        $obj = new self;

        $obj->status = $status instanceof Status ? $status->value : $status;

        null !== $channelPreferences && $obj->channelPreferences = $channelPreferences;
        null !== $rules && $obj->rules = $rules;
        null !== $source && $obj->source = $source instanceof Source ? $source->value : $source;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj->status = $status instanceof Status ? $status->value : $status;

        return $obj;
    }

    /**
     * @param list<ChannelPreference>|null $channelPreferences
     */
    public function withChannelPreferences(?array $channelPreferences): self
    {
        $obj = clone $this;
        $obj->channelPreferences = $channelPreferences;

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

    /**
     * @param Source|value-of<Source>|null $source
     */
    public function withSource(Source|string|null $source): self
    {
        $obj = clone $this;
        $obj->source = $source instanceof Source ? $source->value : $source;

        return $obj;
    }
}
