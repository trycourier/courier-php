<?php

declare(strict_types=1);

namespace Courier\Bulk\InboundBulkMessage;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;

/**
 * Elemental content (optional, for V2 format). When provided, this will be used
 * instead of the notification associated with the `event` field.
 *
 * @phpstan-import-type ElementalContentSugarShape from \Courier\ElementalContentSugar
 * @phpstan-import-type ElementalContentShape from \Courier\ElementalContent
 *
 * @phpstan-type ContentShape = ElementalContentSugarShape|ElementalContentShape
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
