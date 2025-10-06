<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Audiences\Paging;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Lists\Subscriptions\SubscriptionListResponse\Item;

/**
 * @phpstan-type subscription_list_response = array{
 *   items: list<Item>, paging: Paging
 * }
 */
final class SubscriptionListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<subscription_list_response> */
    use SdkModel;

    use SdkResponse;

    /** @var list<Item> $items */
    #[Api(list: Item::class)]
    public array $items;

    #[Api]
    public Paging $paging;

    /**
     * `new SubscriptionListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionListResponse::with(items: ..., paging: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionListResponse)->withItems(...)->withPaging(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Item> $items
     */
    public static function with(array $items, Paging $paging): self
    {
        $obj = new self;

        $obj->items = $items;
        $obj->paging = $paging;

        return $obj;
    }

    /**
     * @param list<Item> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    public function withPaging(Paging $paging): self
    {
        $obj = clone $this;
        $obj->paging = $paging;

        return $obj;
    }
}
