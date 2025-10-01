<?php

declare(strict_types=1);

namespace Courier\Bulk\InboundBulkMessage;

use Courier\Bulk\InboundBulkMessage\Message\InboundBulkContentMessage;
use Courier\Bulk\InboundBulkMessage\Message\InboundBulkTemplateMessage;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * Describes the content of the message in a way that will
 * work for email, push, chat, or any channel.
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
        return [
            InboundBulkTemplateMessage::class, InboundBulkContentMessage::class,
        ];
    }
}
