<?php

declare(strict_types=1);

namespace Courier\Send\Content;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\ElementalNode;
use Courier\Send\ElementalNode\Type;
use Courier\Send\ElementalNode\UnionMember0;
use Courier\Send\ElementalNode\UnionMember1;
use Courier\Send\ElementalNode\UnionMember3;
use Courier\Send\ElementalNode\UnionMember4;
use Courier\Send\ElementalNode\UnionMember5;
use Courier\Send\ElementalNode\UnionMember6;
use Courier\Send\ElementalNode\UnionMember7;

/**
 * @phpstan-type elemental_content = array{
 *   elements: list<UnionMember0|UnionMember1|Type|UnionMember3|UnionMember4|UnionMember5|union_member6|UnionMember7>,
 *   version: string,
 *   brand?: mixed,
 * }
 */
final class ElementalContent implements BaseModel
{
    /** @use SdkModel<elemental_content> */
    use SdkModel;

    /**
     * @var list<UnionMember0|UnionMember1|Type|UnionMember3|UnionMember4|UnionMember5|UnionMember6|UnionMember7> $elements
     */
    #[Api(list: ElementalNode::class)]
    public array $elements;

    /**
     * For example, "2022-01-01".
     */
    #[Api]
    public string $version;

    #[Api(optional: true)]
    public mixed $brand;

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
     * @param list<UnionMember0|UnionMember1|Type|UnionMember3|UnionMember4|UnionMember5|UnionMember6|UnionMember7> $elements
     */
    public static function with(
        array $elements,
        string $version,
        mixed $brand = null
    ): self {
        $obj = new self;

        $obj->elements = $elements;
        $obj->version = $version;

        null !== $brand && $obj->brand = $brand;

        return $obj;
    }

    /**
     * @param list<UnionMember0|UnionMember1|Type|UnionMember3|UnionMember4|UnionMember5|UnionMember6|UnionMember7> $elements
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

    public function withBrand(mixed $brand): self
    {
        $obj = clone $this;
        $obj->brand = $brand;

        return $obj;
    }
}
