<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Commons\Types\Paging;

class BulkGetJobUsersResponse extends JsonSerializableType
{
    /**
     * @var array<BulkMessageUserResponse> $items
     */
    #[JsonProperty('items'), ArrayType([BulkMessageUserResponse::class])]
    public array $items;

    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @param array{
     *   items: array<BulkMessageUserResponse>,
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
