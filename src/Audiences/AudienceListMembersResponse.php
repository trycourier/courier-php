<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\AudienceListMembersResponse\Item;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-type AudienceListMembersResponseShape = array{
 *   items: list<Item>, paging: Paging
 * }
 */
final class AudienceListMembersResponse implements BaseModel
{
    /** @use SdkModel<AudienceListMembersResponseShape> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Api(list: Item::class)]
    public array $items;

    #[Api]
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
     * @param list<Item|array{
     *   added_at: string,
     *   audience_id: string,
     *   audience_version: int,
     *   member_id: string,
     *   reason: string,
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
     * @param list<Item|array{
     *   added_at: string,
     *   audience_id: string,
     *   audience_version: int,
     *   member_id: string,
     *   reason: string,
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
