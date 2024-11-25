<?php

namespace Courier\Messages\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class RenderedMessageBlock extends JsonSerializableType
{
    /**
     * @var string $type The block type of the rendered message block.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string $text The block text of the rendered message block.
     */
    #[JsonProperty('text')]
    public string $text;

    /**
     * @param array{
     *   type: string,
     *   text: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->text = $values['text'];
    }
}
