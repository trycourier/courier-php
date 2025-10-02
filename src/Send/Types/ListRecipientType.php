<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;

class ListRecipientType extends JsonSerializableType
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
