<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Paging;
use Courier\UserList;

/**
 * @phpstan-type list_list_response = array{items: list<UserList>, paging: Paging}
 */
final class ListListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<list_list_response> */
    use SdkModel;

    use SdkResponse;

    /** @var list<UserList> $items */
    #[Api(list: UserList::class)]
    public array $items;

    #[Api]
    public Paging $paging;

    /**
     * `new ListListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ListListResponse::with(items: ..., paging: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ListListResponse)->withItems(...)->withPaging(...)
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
     * @param list<UserList> $items
     */
    public static function with(array $items, Paging $paging): self
    {
        $obj = new self;

        $obj->items = $items;
        $obj->paging = $paging;

        return $obj;
    }

    /**
     * @param list<UserList> $items
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
