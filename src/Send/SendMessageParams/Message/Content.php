<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\SendMessageParams\Message\Content\ElementalContent;
use Courier\Send\SendMessageParams\Message\Content\ElementalContentSugar;

/**
 * Describes content that will work for email, inbox, push, chat, or any channel id.
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
