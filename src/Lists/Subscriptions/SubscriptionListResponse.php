<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Lists\Subscriptions\SubscriptionListResponse\Item;
use Courier\Paging;
use Courier\RecipientPreferences;

/**
 * @phpstan-type SubscriptionListResponseShape = array{
 *   items: list<Item>, paging: Paging
 * }
 */
final class SubscriptionListResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionListResponseShape> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Required(list: Item::class)]
    public array $items;

    #[Required]
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
     * @param list<Item|array{
     *   recipientID: string,
     *   created?: string|null,
     *   preferences?: RecipientPreferences|null,
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
     *   recipientID: string,
     *   created?: string|null,
     *   preferences?: RecipientPreferences|null,
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
