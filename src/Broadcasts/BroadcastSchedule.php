<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Broadcasts\BroadcastSchedule\RecipientType;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * The delivery schedule and recipient targeting for a broadcast.
 *
 * @phpstan-type BroadcastScheduleShape = array{
 *   recipientID: string,
 *   recipientType: RecipientType|value-of<RecipientType>,
 *   scheduledTo?: string|null,
 *   timezone?: string|null,
 * }
 */
final class BroadcastSchedule implements BaseModel
{
    /** @use SdkModel<BroadcastScheduleShape> */
    use SdkModel;

    /**
     * ID of the target list or audience.
     */
    #[Required('recipient_id')]
    public string $recipientID;

    /**
     * Whether the broadcast targets a list or an audience.
     *
     * @var value-of<RecipientType> $recipientType
     */
    #[Required('recipient_type', enum: RecipientType::class)]
    public string $recipientType;

    /**
     * Wall-clock timestamp of the scheduled send, no timezone offset (e.g. "2026-07-21T20:00:00").
     */
    #[Optional('scheduled_to', nullable: true)]
    public ?string $scheduledTo;

    /**
     * IANA timezone for the scheduled send (e.g. America/New_York).
     */
    #[Optional(nullable: true)]
    public ?string $timezone;

    /**
     * `new BroadcastSchedule()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BroadcastSchedule::with(recipientID: ..., recipientType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BroadcastSchedule)->withRecipientID(...)->withRecipientType(...)
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
     * @param RecipientType|value-of<RecipientType> $recipientType
     */
    public static function with(
        string $recipientID,
        RecipientType|string $recipientType,
        ?string $scheduledTo = null,
        ?string $timezone = null,
    ): self {
        $self = new self;

        $self['recipientID'] = $recipientID;
        $self['recipientType'] = $recipientType;

        null !== $scheduledTo && $self['scheduledTo'] = $scheduledTo;
        null !== $timezone && $self['timezone'] = $timezone;

        return $self;
    }

    /**
     * ID of the target list or audience.
     */
    public function withRecipientID(string $recipientID): self
    {
        $self = clone $this;
        $self['recipientID'] = $recipientID;

        return $self;
    }

    /**
     * Whether the broadcast targets a list or an audience.
     *
     * @param RecipientType|value-of<RecipientType> $recipientType
     */
    public function withRecipientType(RecipientType|string $recipientType): self
    {
        $self = clone $this;
        $self['recipientType'] = $recipientType;

        return $self;
    }

    /**
     * Wall-clock timestamp of the scheduled send, no timezone offset (e.g. "2026-07-21T20:00:00").
     */
    public function withScheduledTo(?string $scheduledTo): self
    {
        $self = clone $this;
        $self['scheduledTo'] = $scheduledTo;

        return $self;
    }

    /**
     * IANA timezone for the scheduled send (e.g. America/New_York).
     */
    public function withTimezone(?string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }
}
