<?php

namespace Courier\Templates\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class TagData extends JsonSerializableType
{
    /**
     * @var string $id A unique identifier of the tag.
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $name Name of the tag.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
    }
}
