<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class RecipientPreferences extends JsonSerializableType
{
    /**
     * @var ?array<string, NotificationPreferenceDetails> $categories
     */
    #[JsonProperty('categories'), ArrayType(['string' => NotificationPreferenceDetails::class])]
    public ?array $categories;

    /**
     * @var ?array<string, NotificationPreferenceDetails> $notifications
     */
    #[JsonProperty('notifications'), ArrayType(['string' => NotificationPreferenceDetails::class])]
    public ?array $notifications;

    /**
     * @param array{
     *   categories?: ?array<string, NotificationPreferenceDetails>,
     *   notifications?: ?array<string, NotificationPreferenceDetails>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->categories = $values['categories'] ?? null;
        $this->notifications = $values['notifications'] ?? null;
    }
}
