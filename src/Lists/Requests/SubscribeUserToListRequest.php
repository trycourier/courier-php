<?php

namespace Courier\Lists\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\RecipientPreferences;
use Courier\Core\Json\JsonProperty;

class SubscribeUserToListRequest extends JsonSerializableType
{
    /**
     * @var ?RecipientPreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?RecipientPreferences $preferences;

    /**
     * @param array{
     *   preferences?: ?RecipientPreferences,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->preferences = $values['preferences'] ?? null;
    }
}
