<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * List notification templates in your workspace.
 *
 * @see Courier\Services\NotificationsService::list()
 *
 * @phpstan-type NotificationListParamsShape = array{
 *   cursor?: string|null, eventID?: string|null, notes?: bool|null
 * }
 */
final class NotificationListParams implements BaseModel
{
    /** @use SdkModel<NotificationListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Opaque pagination cursor from a previous response. Omit for the first page.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * Filter to templates linked to this event map ID.
     */
    #[Optional]
    public ?string $eventID;

    /**
     * Include template notes in the response. Only applies to legacy templates.
     */
    #[Optional(nullable: true)]
    public ?bool $notes;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $cursor = null,
        ?string $eventID = null,
        ?bool $notes = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $eventID && $self['eventID'] = $eventID;
        null !== $notes && $self['notes'] = $notes;

        return $self;
    }

    /**
     * Opaque pagination cursor from a previous response. Omit for the first page.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Filter to templates linked to this event map ID.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * Include template notes in the response. Only applies to legacy templates.
     */
    public function withNotes(?bool $notes): self
    {
        $self = clone $this;
        $self['notes'] = $notes;

        return $self;
    }
}
