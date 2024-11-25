<?php

namespace Courier\Lists\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\RecipientPreferences;

class PutSubscriptionsRecipient extends JsonSerializableType
{
    /**
     * @var string $recipientId
     */
    #[JsonProperty('recipientId')]
    public string $recipientId;

    /**
     * @var ?RecipientPreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?RecipientPreferences $preferences;

    /**
     * @param array{
     *   recipientId: string,
     *   preferences?: ?RecipientPreferences,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->recipientId = $values['recipientId'];
        $this->preferences = $values['preferences'] ?? null;
    }
}
