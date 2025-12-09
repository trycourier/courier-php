<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandSnippetsShape = array{items?: list<BrandSnippet>|null}
 */
final class BrandSnippets implements BaseModel
{
    /** @use SdkModel<BrandSnippetsShape> */
    use SdkModel;

    /** @var list<BrandSnippet>|null $items */
    #[Optional(list: BrandSnippet::class, nullable: true)]
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
     * @param list<BrandSnippet|array{name: string, value: string}>|null $items
     */
    public static function with(?array $items = null): self
    {
        $self = new self;

        null !== $items && $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<BrandSnippet|array{name: string, value: string}>|null $items
     */
    public function withItems(?array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
