<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Locale extends JsonSerializableType
{
    /**
     * @var string $content
     */
    #[JsonProperty('content')]
    public string $content;

    /**
     * @param array{
     *   content: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->content = $values['content'];
    }
}
