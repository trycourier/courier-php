<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;

/**
 * Describes content that will work for email, inbox, push, chat, or any channel id.
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
