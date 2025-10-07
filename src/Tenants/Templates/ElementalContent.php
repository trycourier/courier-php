<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\Templates\ElementalContent\Element;
use Courier\Tenants\Templates\ElementalContent\Element\UnionMember0;
use Courier\Tenants\Templates\ElementalContent\Element\UnionMember1;
use Courier\Tenants\Templates\ElementalContent\Element\UnionMember2;
use Courier\Tenants\Templates\ElementalContent\Element\UnionMember3;
use Courier\Tenants\Templates\ElementalContent\Element\UnionMember4;
use Courier\Tenants\Templates\ElementalContent\Element\UnionMember5;
use Courier\Tenants\Templates\ElementalContent\Element\UnionMember6;

/**
 * @phpstan-type elemental_content = array{
 *   elements: list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6>,
 *   version: string,
 *   brand?: string|null,
 * }
 */
final class ElementalContent implements BaseModel
{
    /** @use SdkModel<elemental_content> */
    use SdkModel;

    /**
     * @var list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6> $elements
     */
    #[Api(list: Element::class)]
    public array $elements;

    /**
     * For example, "2022-01-01".
     */
    #[Api]
    public string $version;

    #[Api(nullable: true, optional: true)]
    public ?string $brand;

    /**
     * `new ElementalContent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementalContent::with(elements: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementalContent)->withElements(...)->withVersion(...)
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
     * @param list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6> $elements
     */
    public static function with(
        array $elements,
        string $version,
        ?string $brand = null
    ): self {
        $obj = new self;

        $obj->elements = $elements;
        $obj->version = $version;

        null !== $brand && $obj->brand = $brand;

        return $obj;
    }

    /**
     * @param list<UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6> $elements
     */
    public function withElements(array $elements): self
    {
        $obj = clone $this;
        $obj->elements = $elements;

        return $obj;
    }

    /**
     * For example, "2022-01-01".
     */
    public function withVersion(string $version): self
    {
        $obj = clone $this;
        $obj->version = $version;

        return $obj;
    }

    public function withBrand(?string $brand): self
    {
        $obj = clone $this;
        $obj->brand = $brand;

        return $obj;
    }
}
