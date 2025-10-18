<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_snippets = array{items?: list<BrandSnippet>|null}
 */
final class BrandSnippets implements BaseModel
{
    /** @use SdkModel<brand_snippets> */
    use SdkModel;

    /** @var list<BrandSnippet>|null $items */
    #[Api(list: BrandSnippet::class, nullable: true, optional: true)]
    public ?array $items;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<BrandSnippet>|null $items
     */
    public static function with(?array $items = null): self
    {
        $obj = new self;

        null !== $items && $obj->items = $items;

        return $obj;
    }

    /**
     * @param list<BrandSnippet>|null $items
     */
    public function withItems(?array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }
}
