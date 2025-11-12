<?php

declare(strict_types=1);

namespace Courier\Bulk\InboundBulkMessage\InboundBulkContentMessage;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;

/**
 * Syntactic sugar to provide a fast shorthand for Courier Elemental Blocks.
 */
final class Content implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [ElementalContentSugar::class, ElementalContent::class];
    }
}
