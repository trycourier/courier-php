<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class TrackingOverride extends JsonSerializableType
{
    /**
     * @var bool $open
     */
    #[JsonProperty('open')]
    public bool $open;

    /**
     * @param array{
     *   open: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->open = $values['open'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
