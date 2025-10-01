<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\ElementalNode\UnionMember0;
use Courier\Send\ElementalNode\UnionMember1;
use Courier\Send\ElementalNode\UnionMember2;
use Courier\Send\ElementalNode\UnionMember3;
use Courier\Send\ElementalNode\UnionMember4;
use Courier\Send\ElementalNode\UnionMember5;
use Courier\Send\ElementalNode\UnionMember6;
use Courier\Send\ElementalNode\UnionMember7;

/**
 * The channel element allows a notification to be customized based on which channel it is sent through.
 * For example, you may want to display a detailed message when the notification is sent through email,
 * and a more concise message in a push notification. Channel elements are only valid as top-level
 * elements; you cannot nest channel elements. If there is a channel element specified at the top-level
 * of the document, all sibling elements must be channel elements.
 * Note: As an alternative, most elements support a `channel` property. Which allows you to selectively
 * display an individual element on a per channel basis. See the
 * [control flow docs](https://www.courier.com/docs/platform/content/elemental/control-flow/) for more details.
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
            UnionMember2::class,
            UnionMember3::class,
            UnionMember4::class,
            UnionMember5::class,
            UnionMember6::class,
            UnionMember7::class,
        ];
    }
}
