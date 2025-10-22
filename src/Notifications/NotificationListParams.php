<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * @see Courier\Notifications->list
 *
 * @phpstan-type notification_list_params = array{
 *   cursor?: string|null, notes?: bool|null
 * }
 */
final class NotificationListParams implements BaseModel
{
    /** @use SdkModel<notification_list_params> */
    use SdkModel;
    use SdkParams;

    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    /**
     * Retrieve the notes from the Notification template settings.
     */
    #[Api(nullable: true, optional: true)]
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
        ?bool $notes = null
    ): self {
        $obj = new self;

        null !== $cursor && $obj->cursor = $cursor;
        null !== $notes && $obj->notes = $notes;

        return $obj;
    }

    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * Retrieve the notes from the Notification template settings.
     */
    public function withNotes(?bool $notes): self
    {
        $obj = clone $this;
        $obj->notes = $notes;

        return $obj;
    }
}
