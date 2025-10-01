<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\BrandSnippets\Item;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_snippets = array{items: list<Item>}
 */
final class BrandSnippets implements BaseModel
{
    /** @use SdkModel<brand_snippets> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Api(list: Item::class)]
    public array $items;

    /**
     * `new BrandSnippets()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandSnippets::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandSnippets)->withItems(...)
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
    public static function with(array $items): self
    {
        $obj = new self;

        $obj->items = $items;

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
}
