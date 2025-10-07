<?php

declare(strict_types=1);

namespace Courier\Bulk\InboundBulkMessage\InboundBulkContentMessage;

use Courier\Bulk\InboundBulkMessage\InboundBulkContentMessage\Content\ElementalContentSugar;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Tenants\Templates\ElementalContent;

/**
 * Syntactic sugar to provide a fast shorthand for Courier Elemental Blocks.
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
        return [ElementalContentSugar::class, ElementalContent::class];
    }
}
