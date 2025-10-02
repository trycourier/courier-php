<?php

declare(strict_types=1);

namespace Courier\Send\Content\ElementalContent;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\Content\ElementalContent\Element\UnionMember0;
use Courier\Send\Content\ElementalContent\Element\UnionMember1;
use Courier\Send\Content\ElementalContent\Element\UnionMember2;
use Courier\Send\Content\ElementalContent\Element\UnionMember3;
use Courier\Send\Content\ElementalContent\Element\UnionMember4;
use Courier\Send\Content\ElementalContent\Element\UnionMember5;

final class Element implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
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
        ];
    }
}
