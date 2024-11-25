<?php

namespace Courier\Notifications\Requests;

use Courier\Core\Json\JsonSerializableType;

class NotificationListParams extends JsonSerializableType
{
    /**
     * @var ?string $cursor
     */
    public ?string $cursor;

    /**
     * @var ?bool $notes Retrieve the notes from the Notification template settings.
     */
    public ?bool $notes;

    /**
     * @param array{
     *   cursor?: ?string,
     *   notes?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->cursor = $values['cursor'] ?? null;
        $this->notes = $values['notes'] ?? null;
    }
}
