<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-import-type SubscriptionListShape from \Courier\Lists\SubscriptionList
 * @phpstan-import-type PagingShape from \Courier\Paging
 *
 * @phpstan-type ListListResponseShape = array{
 *   items: list<SubscriptionListShape>, paging: Paging|PagingShape
 * }
 */
final class ListListResponse implements BaseModel
{
    /** @use SdkModel<ListListResponseShape> */
    use SdkModel;

    /** @var list<SubscriptionList> $items */
    #[Required(list: SubscriptionList::class)]
    public array $items;

    #[Required]
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
     * @param list<SubscriptionListShape> $items
     * @param PagingShape $paging
     */
    public static function with(array $items, Paging|array $paging): self
    {
        $self = new self;

        $self['items'] = $items;
        $self['paging'] = $paging;

        return $self;
    }

    /**
     * @param list<SubscriptionListShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * @param PagingShape $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $self = clone $this;
        $self['paging'] = $paging;

        return $self;
    }
}
