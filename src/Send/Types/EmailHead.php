<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class EmailHead extends JsonSerializableType
{
    /**
     * @var bool $inheritDefault
     */
    #[JsonProperty('inheritDefault')]
    public bool $inheritDefault;

    /**
     * @var ?string $content
     */
    #[JsonProperty('content')]
    public ?string $content;

    /**
     * @param array{
     *   inheritDefault: bool,
     *   content?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->inheritDefault = $values['inheritDefault'];
        $this->content = $values['content'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
