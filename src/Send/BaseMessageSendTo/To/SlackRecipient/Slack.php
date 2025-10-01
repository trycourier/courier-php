<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\SlackRecipient;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient\Slack\SendToSlackChannel;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient\Slack\SendToSlackEmail;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient\Slack\SendToSlackUserID;

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
