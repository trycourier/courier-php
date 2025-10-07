<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\Preferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Recipient\Preferences\Category\ChannelPreference;
use Courier\Send\Recipient\Preferences\Category\Rule;
use Courier\Send\Recipient\Preferences\Category\Source;
use Courier\Users\Preferences\PreferenceStatus;

/**
 * @phpstan-type category_alias = array{
 *   status: value-of<PreferenceStatus>,
 *   channelPreferences?: list<ChannelPreference>|null,
 *   rules?: list<Rule>|null,
 *   source?: value-of<Source>|null,
 * }
 */
final class Category implements BaseModel
{
    /** @use SdkModel<category_alias> */
    use SdkModel;

    /** @var value-of<PreferenceStatus> $status */
    #[Api(enum: PreferenceStatus::class)]
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
     * `new Category()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Category::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Category)->withStatus(...)
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
     * @param list<ChannelPreference>|null $channelPreferences
     * @param list<Rule>|null $rules
     * @param Source|value-of<Source>|null $source
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $channelPreferences = null,
        ?array $rules = null,
        Source|string|null $source = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;

        null !== $channelPreferences && $obj->channelPreferences = $channelPreferences;
        null !== $rules && $obj->rules = $rules;
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
        $obj['source'] = $source;

        return $obj;
    }
}
