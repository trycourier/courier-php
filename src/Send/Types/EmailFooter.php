<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class EmailFooter extends JsonSerializableType
{
    /**
     * @var mixed $content
     */
    #[JsonProperty('content')]
    public mixed $content;

    /**
     * @var ?bool $inheritDefault
     */
    #[JsonProperty('inheritDefault')]
    public ?bool $inheritDefault;

    /**
     * @param array{
     *   content?: mixed,
     *   inheritDefault?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->content = $values['content'] ?? null;
        $this->inheritDefault = $values['inheritDefault'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
