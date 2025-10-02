<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\ElementalNode\Type;
use Courier\Send\ElementalNode\UnionMember0;
use Courier\Send\ElementalNode\UnionMember1;
use Courier\Send\ElementalNode\UnionMember3;
use Courier\Send\ElementalNode\UnionMember4;
use Courier\Send\ElementalNode\UnionMember5;
use Courier\Send\ElementalNode\UnionMember6;
use Courier\Send\ElementalNode\UnionMember7;

/**
 * Allows you to group elements together. This can be useful when used in combination with "if" or "loop". See [control flow docs](https://www.courier.com/docs/platform/content/elemental/control-flow/) for more details.
 */
final class ElementalNode implements ConverterSource
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
            Type::class,
            UnionMember3::class,
            UnionMember4::class,
            UnionMember5::class,
            UnionMember6::class,
            UnionMember7::class,
        ];
    }
}
