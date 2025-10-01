<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions\RecipientPreferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Lists\Subscriptions\RecipientPreferences\Notification\ChannelPreference;
use Courier\Lists\Subscriptions\RecipientPreferences\Notification\Rule;
use Courier\Users\Preferences\PreferenceStatus;

/**
 * @phpstan-type notification_alias = array{
 *   status: value-of<PreferenceStatus>,
 *   channelPreferences?: list<ChannelPreference>|null,
 *   rules?: list<Rule>|null,
 * }
 */
final class Notification implements BaseModel
{
    /** @use SdkModel<notification_alias> */
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

    /**
     * `new Notification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Notification::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Notification)->withStatus(...)
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
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $channelPreferences = null,
        ?array $rules = null,
    ): self {
        $obj = new self;

        $obj->status = $status instanceof PreferenceStatus ? $status->value : $status;

        null !== $channelPreferences && $obj->channelPreferences = $channelPreferences;
        null !== $rules && $obj->rules = $rules;

        return $obj;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $obj = clone $this;
        $obj->status = $status instanceof PreferenceStatus ? $status->value : $status;

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
}
