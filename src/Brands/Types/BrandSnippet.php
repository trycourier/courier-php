<?php

namespace Courier\Brands\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BrandSnippet extends JsonSerializableType
{
    /**
     * @var string $format
     */
    #[JsonProperty('format')]
    public string $format;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $value
     */
    #[JsonProperty('value')]
    public string $value;

    /**
     * @param array{
     *   format: string,
     *   name: string,
     *   value: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->format = $values['format'];
        $this->name = $values['name'];
        $this->value = $values['value'];
    }
}
