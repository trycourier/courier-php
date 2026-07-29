<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Broadcasts\Broadcast\Channel;
use Courier\Broadcasts\Broadcast\Status;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A broadcast — a single-channel message delivered to a known set of recipients (a list or audience).
 *
 * @phpstan-import-type BroadcastScheduleShape from \Courier\Broadcasts\BroadcastSchedule
 *
 * @phpstan-type BroadcastShape = array{
 *   id: string,
 *   channel: Channel|value-of<Channel>,
 *   createdAt: string,
 *   createdBy: string,
 *   name: string,
 *   status: Status|value-of<Status>,
 *   updatedAt: string,
 *   updatedBy: string,
 *   archivedAt?: string|null,
 *   archivedBy?: string|null,
 *   schedule?: null|BroadcastSchedule|BroadcastScheduleShape,
 * }
 */
final class Broadcast implements BaseModel
{
    /** @use SdkModel<BroadcastShape> */
    use SdkModel;

    /**
     * The broadcast ID (bst_ prefix).
     */
    #[Required]
    public string $id;

    /**
     * The broadcast's delivery channel.
     *
     * @var value-of<Channel> $channel
     */
    #[Required(enum: Channel::class)]
    public string $channel;

    /**
     * ISO 8601 timestamp when the broadcast was created.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * Actor that created the broadcast.
     */
    #[Required('created_by')]
    public string $createdBy;

    /**
     * Human-readable name.
     */
    #[Required]
    public string $name;

    /**
     * Lifecycle status of the broadcast.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * ISO 8601 timestamp of the last update.
     */
    #[Required('updated_at')]
    public string $updatedAt;

    /**
     * Actor that last updated the broadcast.
     */
    #[Required('updated_by')]
    public string $updatedBy;

    /**
     * ISO 8601 timestamp when the broadcast was archived, if archived.
     */
    #[Optional('archived_at', nullable: true)]
    public ?string $archivedAt;

    /**
     * Actor that archived the broadcast, if archived.
     */
    #[Optional('archived_by', nullable: true)]
    public ?string $archivedBy;

    /**
     * The delivery schedule and recipient targeting for a broadcast.
     */
    #[Optional(nullable: true)]
    public ?BroadcastSchedule $schedule;

    /**
     * `new Broadcast()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Broadcast::with(
     *   id: ...,
     *   channel: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   name: ...,
     *   status: ...,
     *   updatedAt: ...,
     *   updatedBy: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Broadcast)
     *   ->withID(...)
     *   ->withChannel(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withName(...)
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
     *   ->withUpdatedBy(...)
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
     * @param Channel|value-of<Channel> $channel
     * @param Status|value-of<Status> $status
     * @param BroadcastSchedule|BroadcastScheduleShape|null $schedule
     */
    public static function with(
        string $id,
        Channel|string $channel,
        string $createdAt,
        string $createdBy,
        string $name,
        Status|string $status,
        string $updatedAt,
        string $updatedBy,
        ?string $archivedAt = null,
        ?string $archivedBy = null,
        BroadcastSchedule|array|null $schedule = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['channel'] = $channel;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['name'] = $name;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;
        $self['updatedBy'] = $updatedBy;

        null !== $archivedAt && $self['archivedAt'] = $archivedAt;
        null !== $archivedBy && $self['archivedBy'] = $archivedBy;
        null !== $schedule && $self['schedule'] = $schedule;

        return $self;
    }

    /**
     * The broadcast ID (bst_ prefix).
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The broadcast's delivery channel.
     *
     * @param Channel|value-of<Channel> $channel
     */
    public function withChannel(Channel|string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    /**
     * ISO 8601 timestamp when the broadcast was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Actor that created the broadcast.
     */
    public function withCreatedBy(string $createdBy): self
    {
        $self = clone $this;
        $self['createdBy'] = $createdBy;

        return $self;
    }

    /**
     * Human-readable name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Lifecycle status of the broadcast.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * ISO 8601 timestamp of the last update.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Actor that last updated the broadcast.
     */
    public function withUpdatedBy(string $updatedBy): self
    {
        $self = clone $this;
        $self['updatedBy'] = $updatedBy;

        return $self;
    }

    /**
     * ISO 8601 timestamp when the broadcast was archived, if archived.
     */
    public function withArchivedAt(?string $archivedAt): self
    {
        $self = clone $this;
        $self['archivedAt'] = $archivedAt;

        return $self;
    }

    /**
     * Actor that archived the broadcast, if archived.
     */
    public function withArchivedBy(?string $archivedBy): self
    {
        $self = clone $this;
        $self['archivedBy'] = $archivedBy;

        return $self;
    }

    /**
     * The delivery schedule and recipient targeting for a broadcast.
     *
     * @param BroadcastSchedule|BroadcastScheduleShape|null $schedule
     */
    public function withSchedule(BroadcastSchedule|array|null $schedule): self
    {
        $self = clone $this;
        $self['schedule'] = $schedule;

        return $self;
    }
}
