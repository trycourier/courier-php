<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Broadcasts\BroadcastScheduleParams\RecipientType;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Schedule a broadcast for a future send to a list or audience. Publishes the broadcast template first. Not allowed once the broadcast is sending or sent. For an immediate send use POST /broadcasts/{broadcastId}/send.
 *
 * @see Courier\Services\BroadcastsService::schedule()
 *
 * @phpstan-type BroadcastScheduleParamsShape = array{
 *   recipientID: string,
 *   recipientType: RecipientType|value-of<RecipientType>,
 *   scheduledTo: string,
 *   timezone?: string|null,
 * }
 */
final class BroadcastScheduleParams implements BaseModel
{
    /** @use SdkModel<BroadcastScheduleParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Wall-clock timestamp of the future send, no timezone offset (e.g. "2026-07-21T20:00:00"). The zone is given by `timezone`.
     */
    #[Required('scheduled_to')]
    public string $scheduledTo;

    /**
     * IANA timezone for the scheduled send (e.g. America/New_York).
     */
    #[Optional]
    public ?string $timezone;

    /**
     * `new BroadcastScheduleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BroadcastScheduleParams::with(
     *   recipientID: ..., recipientType: ..., scheduledTo: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BroadcastScheduleParams)
     *   ->withRecipientID(...)
     *   ->withRecipientType(...)
     *   ->withScheduledTo(...)
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
        string $scheduledTo,
        ?string $timezone = null,
    ): self {
        $self = new self;

        $self['recipientID'] = $recipientID;
        $self['recipientType'] = $recipientType;
        $self['scheduledTo'] = $scheduledTo;

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
     * Wall-clock timestamp of the future send, no timezone offset (e.g. "2026-07-21T20:00:00"). The zone is given by `timezone`.
     */
    public function withScheduledTo(string $scheduledTo): self
    {
        $self = clone $this;
        $self['scheduledTo'] = $scheduledTo;

        return $self;
    }

    /**
     * IANA timezone for the scheduled send (e.g. America/New_York).
     */
    public function withTimezone(string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }
}
