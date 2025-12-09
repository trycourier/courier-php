<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Bulk\BulkListUsersResponse\Item;
use Courier\Bulk\BulkListUsersResponse\Item\Status;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;
use Courier\RecipientPreferences;
use Courier\UserRecipient;

/**
 * @phpstan-type BulkListUsersResponseShape = array{
 *   items: list<Item>, paging: Paging
 * }
 */
final class BulkListUsersResponse implements BaseModel
{
    /** @use SdkModel<BulkListUsersResponseShape> */
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
     * @param list<Item|array{
     *   data?: mixed,
     *   preferences?: RecipientPreferences|null,
     *   profile?: mixed,
     *   recipient?: string|null,
     *   to?: UserRecipient|null,
     *   status: value-of<Status>,
     *   messageId?: string|null,
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
     *   data?: mixed,
     *   preferences?: RecipientPreferences|null,
     *   profile?: mixed,
     *   recipient?: string|null,
     *   to?: UserRecipient|null,
     *   status: value-of<Status>,
     *   messageId?: string|null,
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
