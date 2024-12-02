<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ElementalContent extends JsonSerializableType
{
    /**
     * @var string $version For example, "2022-01-01"
     */
    #[JsonProperty('version')]
    public string $version;

    /**
     * @var mixed $brand
     */
    #[JsonProperty('brand')]
    public mixed $brand;

    /**
     * @var array<mixed> $elements
     */
    #[JsonProperty('elements'), ArrayType(['mixed'])]
    public array $elements;

    /**
     * @param array{
     *   version: string,
     *   brand?: mixed,
     *   elements: array<mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->version = $values['version'];
        $this->brand = $values['brand'] ?? null;
        $this->elements = $values['elements'];
    }
}
