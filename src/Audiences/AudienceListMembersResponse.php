<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\AudienceListMembersResponse\Item;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-import-type ItemShape from \Courier\Audiences\AudienceListMembersResponse\Item
 * @phpstan-import-type PagingShape from \Courier\Paging
 *
 * @phpstan-type AudienceListMembersResponseShape = array{
 *   items: list<Item|ItemShape>, paging: Paging|PagingShape
 * }
 */
final class AudienceListMembersResponse implements BaseModel
{
    /** @use SdkModel<AudienceListMembersResponseShape> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Required(list: Item::class)]
    public array $items;

    #[Required]
    public Paging $paging;

    /**
     * `new AudienceListMembersResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AudienceListMembersResponse::with(items: ..., paging: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AudienceListMembersResponse)->withItems(...)->withPaging(...)
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
     * @param list<Item|ItemShape> $items
     * @param Paging|PagingShape $paging
     */
    public static function with(array $items, Paging|array $paging): self
    {
        $self = new self;

        $self['items'] = $items;
        $self['paging'] = $paging;

        return $self;
    }

    /**
     * @param list<Item|ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * @param Paging|PagingShape $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $self = clone $this;
        $self['paging'] = $paging;

        return $self;
    }
}
