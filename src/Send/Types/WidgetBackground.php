<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class WidgetBackground extends JsonSerializableType
{
    /**
     * @var ?string $topColor
     */
    #[JsonProperty('topColor')]
    public ?string $topColor;

    /**
     * @var ?string $bottomColor
     */
    #[JsonProperty('bottomColor')]
    public ?string $bottomColor;

    /**
     * @param array{
     *   topColor?: ?string,
     *   bottomColor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->topColor = $values['topColor'] ?? null;
        $this->bottomColor = $values['bottomColor'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
