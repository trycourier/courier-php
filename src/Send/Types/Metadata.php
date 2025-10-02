<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Metadata extends JsonSerializableType
{
    /**
     * @var ?Utm $utm
     */
    #[JsonProperty('utm')]
    public ?Utm $utm;

    /**
     * @param array{
     *   utm?: ?Utm,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->utm = $values['utm'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
