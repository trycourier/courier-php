<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\Message\ContentMessage;
use Courier\Send\Message\TemplateMessage;

/**
 * Describes the content of the message in a way that will work for email, push, chat, or any channel.
 */
final class Message implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [ContentMessage::class, TemplateMessage::class];
    }
}
