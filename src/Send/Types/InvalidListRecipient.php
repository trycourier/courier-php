<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class InvalidListRecipient extends JsonSerializableType
{
    /**
     * @var string $userId
     */
    #[JsonProperty('user_id')]
    public string $userId;

    /**
     * @var string $listPattern
     */
    #[JsonProperty('list_pattern')]
    public string $listPattern;

    /**
     * @param array{
     *   userId: string,
     *   listPattern: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
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
