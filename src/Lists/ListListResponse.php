<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-type ListListResponseShape = array{
 *   items: list<SubscriptionList>, paging: Paging
 * }
 */
final class ListListResponse implements BaseModel
{
    /** @use SdkModel<ListListResponseShape> */
    use SdkModel;

    /** @var list<SubscriptionList> $items */
    #[Api(list: SubscriptionList::class)]
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
     * @param list<SubscriptionList|array{
     *   id: string, name: string, created?: string|null, updated?: string|null
     * }> $items
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     */
    public static function with(array $items, Paging|array $paging): self
    {
        $obj = new self;

        $obj['items'] = $items;
        $obj['paging'] = $paging;

        return $obj;
    }

    /**
     * @param list<SubscriptionList|array{
     *   id: string, name: string, created?: string|null, updated?: string|null
     * }> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj['items'] = $items;

        return $obj;
    }

    /**
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $obj = clone $this;
        $obj['paging'] = $paging;

        return $obj;
    }
}
