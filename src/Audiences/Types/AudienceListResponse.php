<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Commons\Types\Paging;

class AudienceListResponse extends JsonSerializableType
{
    /**
     * @var array<Audience> $items
     */
    #[JsonProperty('items'), ArrayType([Audience::class])]
    public array $items;

    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @param array{
     *   items: array<Audience>,
     *   paging: Paging,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->items = $values['items'];
        $this->paging = $values['paging'];
    }
}
