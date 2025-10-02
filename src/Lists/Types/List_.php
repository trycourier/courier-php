<?php

namespace Courier\Lists\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class List_ extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?string $created
     */
    #[JsonProperty('created')]
    public ?string $created;

    /**
     * @var ?string $updated
     */
    #[JsonProperty('updated')]
    public ?string $updated;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   created?: ?string,
     *   updated?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->created = $values['created'] ?? null;
        $this->updated = $values['updated'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
