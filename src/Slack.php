<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type SendToSlackChannelShape from \Courier\SendToSlackChannel
 * @phpstan-import-type SendToSlackEmailShape from \Courier\SendToSlackEmail
 * @phpstan-import-type SendToSlackUserIDShape from \Courier\SendToSlackUserID
 *
 * @phpstan-type SlackVariants = SendToSlackChannel|SendToSlackEmail|SendToSlackUserID
 * @phpstan-type SlackShape = SlackVariants|SendToSlackChannelShape|SendToSlackEmailShape|SendToSlackUserIDShape
 */
final class Slack implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            SendToSlackChannel::class,
            SendToSlackEmail::class,
            SendToSlackUserID::class,
        ];
    }
}
