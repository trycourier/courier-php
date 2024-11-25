<?php

namespace Courier\Lists\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\Paging;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ListGetSubscriptionsResponse extends JsonSerializableType
{
    /**
     * @var Paging $paging
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @var array<ListSubscriptionRecipient> $items
     */
    #[JsonProperty('items'), ArrayType([ListSubscriptionRecipient::class])]
    public array $items;

    /**
     * @param array{
     *   paging: Paging,
     *   items: array<ListSubscriptionRecipient>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paging = $values['paging'];
        $this->items = $values['items'];
    }
}
