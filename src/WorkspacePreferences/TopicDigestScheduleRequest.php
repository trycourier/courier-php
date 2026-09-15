<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Digests\DigestDayOfWeek;
use Courier\Digests\DigestFrequency;

/**
 * One delivery cadence for a topic's digest. Supply `schedule_id` to update an existing schedule in place; omit it and one is assigned and returned. The `schedules` array is a full replacement, so a stored schedule absent from it is deleted along with its delivery rule.
 *
 * @phpstan-type TopicDigestScheduleRequestShape = array{
 *   frequency: DigestFrequency|value-of<DigestFrequency>,
 *   dayOfMonth?: int|null,
 *   dayOfWeek?: null|DigestDayOfWeek|value-of<DigestDayOfWeek>,
 *   daysOfWeek?: list<DigestDayOfWeek|value-of<DigestDayOfWeek>>|null,
 *   disabled?: bool|null,
 *   isDefault?: bool|null,
 *   scheduleID?: string|null,
 *   time?: string|null,
 *   timezone?: string|null,
 * }
 */
final class TopicDigestScheduleRequest implements BaseModel
{
    /** @use SdkModel<TopicDigestScheduleRequestShape> */
    use SdkModel;

    /**
     * How often a digest is delivered. `instant` delivers immediately without batching, and is the one value that takes no `time`.
     *
     * @var value-of<DigestFrequency> $frequency
     */
    #[Required(enum: DigestFrequency::class)]
    public string $frequency;

    /**
     * Required when `frequency` is `monthly`.
     */
    #[Optional('day_of_month')]
    public ?int $dayOfMonth;

    /**
     * Required when `frequency` is `weekly`.
     *
     * @var value-of<DigestDayOfWeek>|null $dayOfWeek
     */
    #[Optional('day_of_week', enum: DigestDayOfWeek::class)]
    public ?string $dayOfWeek;

    /**
     * Required when `frequency` is `custom_days`.
     *
     * @var list<value-of<DigestDayOfWeek>>|null $daysOfWeek
     */
    #[Optional('days_of_week', list: DigestDayOfWeek::class)]
    public ?array $daysOfWeek;

    /**
     * Whether the schedule is disabled.
     */
    #[Optional]
    public ?bool $disabled;

    /**
     * The schedule recipients are placed on when they have not chosen one. Set this explicitly rather than relying on array position.
     */
    #[Optional('is_default')]
    public ?bool $isDefault;

    /**
     * Identifier of an existing schedule to update. Omit when creating a new one.
     */
    #[Optional('schedule_id')]
    public ?string $scheduleID;

    /**
     * 24-hour local delivery time, `HH:MM`. Required for every frequency except `instant`.
     */
    #[Optional]
    public ?string $time;

    /**
     * IANA timezone the `time` and day fields are expressed in, e.g. `America/New_York`. Absent means UTC. Delivery follows the same local wall-clock across daylight-saving changes.
     */
    #[Optional]
    public ?string $timezone;

    /**
     * `new TopicDigestScheduleRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicDigestScheduleRequest::with(frequency: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicDigestScheduleRequest)->withFrequency(...)
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
     * @param DigestFrequency|value-of<DigestFrequency> $frequency
     * @param DigestDayOfWeek|value-of<DigestDayOfWeek>|null $dayOfWeek
     * @param list<DigestDayOfWeek|value-of<DigestDayOfWeek>>|null $daysOfWeek
     */
    public static function with(
        DigestFrequency|string $frequency,
        ?int $dayOfMonth = null,
        DigestDayOfWeek|string|null $dayOfWeek = null,
        ?array $daysOfWeek = null,
        ?bool $disabled = null,
        ?bool $isDefault = null,
        ?string $scheduleID = null,
        ?string $time = null,
        ?string $timezone = null,
    ): self {
        $self = new self;

        $self['frequency'] = $frequency;

        null !== $dayOfMonth && $self['dayOfMonth'] = $dayOfMonth;
        null !== $dayOfWeek && $self['dayOfWeek'] = $dayOfWeek;
        null !== $daysOfWeek && $self['daysOfWeek'] = $daysOfWeek;
        null !== $disabled && $self['disabled'] = $disabled;
        null !== $isDefault && $self['isDefault'] = $isDefault;
        null !== $scheduleID && $self['scheduleID'] = $scheduleID;
        null !== $time && $self['time'] = $time;
        null !== $timezone && $self['timezone'] = $timezone;

        return $self;
    }

    /**
     * How often a digest is delivered. `instant` delivers immediately without batching, and is the one value that takes no `time`.
     *
     * @param DigestFrequency|value-of<DigestFrequency> $frequency
     */
    public function withFrequency(DigestFrequency|string $frequency): self
    {
        $self = clone $this;
        $self['frequency'] = $frequency;

        return $self;
    }

    /**
     * Required when `frequency` is `monthly`.
     */
    public function withDayOfMonth(int $dayOfMonth): self
    {
        $self = clone $this;
        $self['dayOfMonth'] = $dayOfMonth;

        return $self;
    }

    /**
     * Required when `frequency` is `weekly`.
     *
     * @param DigestDayOfWeek|value-of<DigestDayOfWeek> $dayOfWeek
     */
    public function withDayOfWeek(DigestDayOfWeek|string $dayOfWeek): self
    {
        $self = clone $this;
        $self['dayOfWeek'] = $dayOfWeek;

        return $self;
    }

    /**
     * Required when `frequency` is `custom_days`.
     *
     * @param list<DigestDayOfWeek|value-of<DigestDayOfWeek>> $daysOfWeek
     */
    public function withDaysOfWeek(array $daysOfWeek): self
    {
        $self = clone $this;
        $self['daysOfWeek'] = $daysOfWeek;

        return $self;
    }

    /**
     * Whether the schedule is disabled.
     */
    public function withDisabled(bool $disabled): self
    {
        $self = clone $this;
        $self['disabled'] = $disabled;

        return $self;
    }

    /**
     * The schedule recipients are placed on when they have not chosen one. Set this explicitly rather than relying on array position.
     */
    public function withIsDefault(bool $isDefault): self
    {
        $self = clone $this;
        $self['isDefault'] = $isDefault;

        return $self;
    }

    /**
     * Identifier of an existing schedule to update. Omit when creating a new one.
     */
    public function withScheduleID(string $scheduleID): self
    {
        $self = clone $this;
        $self['scheduleID'] = $scheduleID;

        return $self;
    }

    /**
     * 24-hour local delivery time, `HH:MM`. Required for every frequency except `instant`.
     */
    public function withTime(string $time): self
    {
        $self = clone $this;
        $self['time'] = $time;

        return $self;
    }

    /**
     * IANA timezone the `time` and day fields are expressed in, e.g. `America/New_York`. Absent means UTC. Delivery follows the same local wall-clock across daylight-saving changes.
     */
    public function withTimezone(string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }
}
