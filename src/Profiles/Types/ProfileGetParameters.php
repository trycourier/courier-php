<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class ProfileGetParameters extends JsonSerializableType
{
    /**
     * @var string $recipientId
     */
    #[JsonProperty('recipientId')]
    public string $recipientId;

    /**
     * @param array{
     *   recipientId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->recipientId = $values['recipientId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
