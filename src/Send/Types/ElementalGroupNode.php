<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ElementalBaseNode;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * Allows you to group elements together. This can be useful when used in combination with "if" or "loop". See [control flow docs](https://www.courier.com/docs/platform/content/elemental/control-flow/) for more details.
 */
class ElementalGroupNode extends JsonSerializableType
{
    use ElementalBaseNode;

    /**
     * @var array<mixed> $elements Sub elements to render.
     */
    #[JsonProperty('elements'), ArrayType(['mixed'])]
    public array $elements;

    /**
     * @param array{
     *   elements: array<mixed>,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->elements = $values['elements'];
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
    }
}
