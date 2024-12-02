<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ElementalBaseNode;
use Courier\Core\Json\JsonProperty;

/**
 * Renders a dividing line between elements.
 */
class ElementalDividerNode extends JsonSerializableType
{
    use ElementalBaseNode;

    /**
     * @var ?string $color The CSS color to render the line with. For example, `#fff`
     */
    #[JsonProperty('color')]
    public ?string $color;

    /**
     * @param array{
     *   color?: ?string,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->color = $values['color'] ?? null;
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
    }
}
