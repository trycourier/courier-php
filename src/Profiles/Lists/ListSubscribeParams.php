<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Profiles\SubscribeToListsRequestItem;

/**
 * Subscribes the given user to one or more lists. If the list does not exist, it will be created.
 *
 * @see Courier\Services\Profiles\ListsService::subscribe()
 *
 * @phpstan-import-type SubscribeToListsRequestItemShape from \Courier\Profiles\SubscribeToListsRequestItem
 *
 * @phpstan-type ListSubscribeParamsShape = array{
 *   lists: list<SubscribeToListsRequestItemShape>
 * }
 */
final class ListSubscribeParams implements BaseModel
{
    /** @use SdkModel<ListSubscribeParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<SubscribeToListsRequestItem> $lists */
    #[Required(list: SubscribeToListsRequestItem::class)]
    public array $lists;

    /**
     * `new ListSubscribeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ListSubscribeParams::with(lists: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ListSubscribeParams)->withLists(...)
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
     * @param list<SubscribeToListsRequestItemShape> $lists
     */
    public static function with(array $lists): self
    {
        $self = new self;

        $self['lists'] = $lists;

        return $self;
    }

    /**
     * @param list<SubscribeToListsRequestItemShape> $lists
     */
    public function withLists(array $lists): self
    {
        $self = clone $this;
        $self['lists'] = $lists;

        return $self;
    }
}
