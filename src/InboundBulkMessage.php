<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\InboundBulkMessage\InboundBulkContentMessage;
use Courier\InboundBulkMessage\InboundBulkTemplateMessage;

final class InboundBulkMessage implements ConverterSource
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
