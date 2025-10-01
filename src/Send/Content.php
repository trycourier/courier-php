<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\Content\ElementalContent;
use Courier\Send\Content\ElementalContentSugar;

/**
 * Syntatic Sugar to provide a fast shorthand for Courier Elemental Blocks.
 */
final class Content implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [ElementalContent::class, ElementalContentSugar::class];
    }
}
