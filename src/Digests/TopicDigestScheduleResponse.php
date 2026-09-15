<?php

declare(strict_types=1);

namespace Courier\Digests;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A delivery cadence for a topic's digest, with its assigned id.
 *
 * @phpstan-type TopicDigestScheduleResponseShape = array{
 *   scheduleID: string,
 *   created?: string|null,
 *   dayOfMonth?: int|null,
 *   dayOfWeek?: null|DigestDayOfWeek|value-of<DigestDayOfWeek>,
 *   daysOfWeek?: list<DigestDayOfWeek|value-of<DigestDayOfWeek>>|null,
 *   disabled?: bool|null,
 *   frequency?: null|DigestFrequency|value-of<DigestFrequency>,
 *   isDefault?: bool|null,
 *   time?: string|null,
 *   timezone?: string|null,
 *   updated?: string|null,
 * }
 */
final class TopicDigestScheduleResponse implements BaseModel
{
    /** @use SdkModel<TopicDigestScheduleResponseShape> */
    use SdkModel;

    /**
     * The schedule's identifier, assigned by the server. This is the value the `/digests/schedules/{schedule_id}` endpoints are keyed by.
     */
    #[Required('schedule_id')]
    public string $scheduleID;

    /**
     * ISO-8601 timestamp of when the schedule was created.
     */
    #[Optional]
    public ?string $created;

    /**
     * Day of the month, 1-31.
     */
    #[Optional('day_of_month')]
    public ?int $dayOfMonth;

    /**
     * A day of the week. Accepted case-insensitively, returned lowercase.
     *
     * @var value-of<DigestDayOfWeek>|null $dayOfWeek
     */
    #[Optional('day_of_week', enum: DigestDayOfWeek::class)]
    public ?string $dayOfWeek;

    /** @var list<value-of<DigestDayOfWeek>>|null $daysOfWeek */
    #[Optional('days_of_week', list: DigestDayOfWeek::class)]
    public ?array $daysOfWeek;

    /**
     * Whether the schedule is disabled.
     */
    #[Optional]
    public ?bool $disabled;

    /**
     * Omitted for a stored schedule this enum cannot express. Those schedules never fire, but their `schedule_id` is still returned so the `/digests/*` endpoints remain reachable for them.
     *
     * @var value-of<DigestFrequency>|null $frequency
     */
    #[Optional(enum: DigestFrequency::class)]
    public ?string $frequency;

    /**
     * Whether this is the schedule recipients are placed on by default.
     */
    #[Optional('is_default')]
    public ?bool $isDefault;

    /**
     * 24-hour local delivery time, `HH:MM`.
     */
    #[Optional]
    public ?string $time;

    /**
     * IANA timezone the schedule is expressed in. Absent means UTC.
     */
    #[Optional]
    public ?string $timezone;

    /**
     * ISO-8601 timestamp of the last update.
     */
    #[Optional]
    public ?string $updated;

    /**
     * `new TopicDigestScheduleResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicDigestScheduleResponse::with(scheduleID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicDigestScheduleResponse)->withScheduleID(...)
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
     * @param DigestDayOfWeek|value-of<DigestDayOfWeek>|null $dayOfWeek
     * @param list<DigestDayOfWeek|value-of<DigestDayOfWeek>>|null $daysOfWeek
     * @param DigestFrequency|value-of<DigestFrequency>|null $frequency
     */
    public static function with(
        string $scheduleID,
        ?string $created = null,
        ?int $dayOfMonth = null,
        DigestDayOfWeek|string|null $dayOfWeek = null,
        ?array $daysOfWeek = null,
        ?bool $disabled = null,
        DigestFrequency|string|null $frequency = null,
        ?bool $isDefault = null,
        ?string $time = null,
        ?string $timezone = null,
        ?string $updated = null,
    ): self {
        $self = new self;

        $self['scheduleID'] = $scheduleID;

        null !== $created && $self['created'] = $created;
        null !== $dayOfMonth && $self['dayOfMonth'] = $dayOfMonth;
        null !== $dayOfWeek && $self['dayOfWeek'] = $dayOfWeek;
        null !== $daysOfWeek && $self['daysOfWeek'] = $daysOfWeek;
        null !== $disabled && $self['disabled'] = $disabled;
        null !== $frequency && $self['frequency'] = $frequency;
        null !== $isDefault && $self['isDefault'] = $isDefault;
        null !== $time && $self['time'] = $time;
        null !== $timezone && $self['timezone'] = $timezone;
        null !== $updated && $self['updated'] = $updated;

        return $self;
    }

    /**
     * The schedule's identifier, assigned by the server. This is the value the `/digests/schedules/{schedule_id}` endpoints are keyed by.
     */
    public function withScheduleID(string $scheduleID): self
    {
        $self = clone $this;
        $self['scheduleID'] = $scheduleID;

        return $self;
    }

    /**
     * ISO-8601 timestamp of when the schedule was created.
     */
    public function withCreated(string $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Day of the month, 1-31.
     */
    public function withDayOfMonth(int $dayOfMonth): self
    {
        $self = clone $this;
        $self['dayOfMonth'] = $dayOfMonth;

        return $self;
    }

    /**
     * A day of the week. Accepted case-insensitively, returned lowercase.
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
     * Omitted for a stored schedule this enum cannot express. Those schedules never fire, but their `schedule_id` is still returned so the `/digests/*` endpoints remain reachable for them.
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
     * Whether this is the schedule recipients are placed on by default.
     */
    public function withIsDefault(bool $isDefault): self
    {
        $self = clone $this;
        $self['isDefault'] = $isDefault;

        return $self;
    }

    /**
     * 24-hour local delivery time, `HH:MM`.
     */
    public function withTime(string $time): self
    {
        $self = clone $this;
        $self['time'] = $time;

        return $self;
    }

    /**
     * IANA timezone the schedule is expressed in. Absent means UTC.
     */
    public function withTimezone(string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }

    /**
     * ISO-8601 timestamp of the last update.
     */
    public function withUpdated(string $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }
}
