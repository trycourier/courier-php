<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\RecipientPreferences;

class SubscribeToListsRequestListObject extends JsonSerializableType
{
    /**
     * @var string $listId
     */
    #[JsonProperty('listId')]
    public string $listId;

    /**
     * @var ?RecipientPreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?RecipientPreferences $preferences;

    /**
     * @param array{
     *   listId: string,
     *   preferences?: ?RecipientPreferences,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->listId = $values['listId'];
        $this->preferences = $values['preferences'] ?? null;
    }
}
