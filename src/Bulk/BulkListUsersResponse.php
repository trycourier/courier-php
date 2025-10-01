<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Audiences\Paging;
use Courier\Bulk\BulkListUsersResponse\Item;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type bulk_list_users_response = array{
 *   items: list<item_alias>, paging: Paging
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class BulkListUsersResponse implements BaseModel
{
    /** @use SdkModel<bulk_list_users_response> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Api(list: Item::class)]
    public array $items;

    #[Api]
    public Paging $paging;

    /**
     * `new BulkListUsersResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkListUsersResponse::with(items: ..., paging: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkListUsersResponse)->withItems(...)->withPaging(...)
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
