<?php

namespace Courier\Lists\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\Paging;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ListGetAllResponse extends JsonSerializableType
{
    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @var array<List_> $items
     */
    #[JsonProperty('items'), ArrayType([List_::class])]
    public array $items;

    /**
     * @param array{
     *   paging: Paging,
     *   items: array<List_>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paging = $values['paging'];
        $this->items = $values['items'];
    }
}
