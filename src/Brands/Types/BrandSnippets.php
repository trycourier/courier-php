<?php

namespace Courier\Brands\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class BrandSnippets extends JsonSerializableType
{
    /**
     * @var array<BrandSnippet> $items
     */
    #[JsonProperty('items'), ArrayType([BrandSnippet::class])]
    public array $items;

    /**
     * @param array{
     *   items: array<BrandSnippet>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->items = $values['items'];
    }
}
