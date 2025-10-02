<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class IProfilePreferences extends JsonSerializableType
{
    /**
     * @var ?array<string, Preference> $categories
     */
    #[JsonProperty('categories'), ArrayType(['string' => Preference::class])]
    public ?array $categories;

    /**
     * @var array<string, Preference> $notifications
     */
    #[JsonProperty('notifications'), ArrayType(['string' => Preference::class])]
    public array $notifications;

    /**
     * @var ?string $templateId
     */
    #[JsonProperty('templateId')]
    public ?string $templateId;

    /**
     * @param array{
     *   notifications: array<string, Preference>,
     *   categories?: ?array<string, Preference>,
     *   templateId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->categories = $values['categories'] ?? null;
        $this->notifications = $values['notifications'];
        $this->templateId = $values['templateId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
