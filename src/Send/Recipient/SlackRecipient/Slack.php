<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\SlackRecipient;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\Recipient\SlackRecipient\Slack\SendToSlackChannel;
use Courier\Send\Recipient\SlackRecipient\Slack\SendToSlackEmail;
use Courier\Send\Recipient\SlackRecipient\Slack\SendToSlackUserID;

final class Slack implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
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
