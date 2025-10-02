<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class InvalidUserRecipient extends JsonSerializableType
{
    /**
     * @var string $listId
     */
    #[JsonProperty('list_id')]
    public string $listId;

    /**
     * @var string $listPattern
     */
    #[JsonProperty('list_pattern')]
    public string $listPattern;

    /**
     * @param array{
     *   listId: string,
     *   listPattern: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->listId = $values['listId'];
        $this->listPattern = $values['listPattern'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
