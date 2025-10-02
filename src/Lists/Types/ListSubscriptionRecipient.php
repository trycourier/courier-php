<?php

namespace Courier\Lists\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\RecipientPreferences;

class ListSubscriptionRecipient extends JsonSerializableType
{
    /**
     * @var string $recipientId
     */
    #[JsonProperty('recipientId')]
    public string $recipientId;

    /**
     * @var ?string $created
     */
    #[JsonProperty('created')]
    public ?string $created;

    /**
     * @var ?RecipientPreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?RecipientPreferences $preferences;

    /**
     * @param array{
     *   recipientId: string,
     *   created?: ?string,
     *   preferences?: ?RecipientPreferences,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->recipientId = $values['recipientId'];
        $this->created = $values['created'] ?? null;
        $this->preferences = $values['preferences'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
