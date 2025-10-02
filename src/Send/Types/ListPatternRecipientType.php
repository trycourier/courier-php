<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;

class ListPatternRecipientType extends JsonSerializableType
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
