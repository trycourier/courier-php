<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\RecipientPreferences;

class GetListSubscriptionsList extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $name List name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $created The date/time of when the list was created. Represented as a string in ISO format.
     */
    #[JsonProperty('created')]
    public string $created;

    /**
     * @var string $updated The date/time of when the list was updated. Represented as a string in ISO format.
     */
    #[JsonProperty('updated')]
    public string $updated;

    /**
     * @var ?RecipientPreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?RecipientPreferences $preferences;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   created: string,
     *   updated: string,
     *   preferences?: ?RecipientPreferences,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->created = $values['created'];
        $this->updated = $values['updated'];
        $this->preferences = $values['preferences'] ?? null;
    }
}
