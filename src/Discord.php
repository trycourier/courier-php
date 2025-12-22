<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type SendToChannelShape from \Courier\SendToChannel
 * @phpstan-import-type SendDirectMessageShape from \Courier\SendDirectMessage
 *
 * @phpstan-type DiscordShape = SendToChannelShape|SendDirectMessageShape
 */
final class Discord implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [SendToChannel::class, SendDirectMessage::class];
    }
}
