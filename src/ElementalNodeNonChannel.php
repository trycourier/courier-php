<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\ElementalNodeNonChannel\UnionMember0;
use Courier\ElementalNodeNonChannel\UnionMember1;
use Courier\ElementalNodeNonChannel\UnionMember2;
use Courier\ElementalNodeNonChannel\UnionMember3;
use Courier\ElementalNodeNonChannel\UnionMember4;
use Courier\ElementalNodeNonChannel\UnionMember5;
use Courier\ElementalNodeNonChannel\UnionMember6;

/**
 * Any Elemental node except a channel block. Channel elements are only valid as top-level elements, so the `elements` nested inside one can never be another channel. Keeping this union channel-free also keeps the schema acyclic; a recursive `$ref` here breaks the generated Python models.
 *
 * @phpstan-import-type UnionMember0Shape from \Courier\ElementalNodeNonChannel\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \Courier\ElementalNodeNonChannel\UnionMember1
 * @phpstan-import-type UnionMember2Shape from \Courier\ElementalNodeNonChannel\UnionMember2
 * @phpstan-import-type UnionMember3Shape from \Courier\ElementalNodeNonChannel\UnionMember3
 * @phpstan-import-type UnionMember4Shape from \Courier\ElementalNodeNonChannel\UnionMember4
 * @phpstan-import-type UnionMember5Shape from \Courier\ElementalNodeNonChannel\UnionMember5
 * @phpstan-import-type UnionMember6Shape from \Courier\ElementalNodeNonChannel\UnionMember6
 *
 * @phpstan-type ElementalNodeNonChannelVariants = UnionMember0|UnionMember1|UnionMember2|UnionMember3|UnionMember4|UnionMember5|UnionMember6
 * @phpstan-type ElementalNodeNonChannelShape = ElementalNodeNonChannelVariants|UnionMember0Shape|UnionMember1Shape|UnionMember2Shape|UnionMember3Shape|UnionMember4Shape|UnionMember5Shape|UnionMember6Shape
 */
final class ElementalNodeNonChannel implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            UnionMember0::class,
            UnionMember1::class,
            UnionMember2::class,
            UnionMember3::class,
            UnionMember4::class,
            UnionMember5::class,
            UnionMember6::class,
        ];
    }
}
