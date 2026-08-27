<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * Send to a Slack address directly, bypassing the recipient's stored profile. Requires exactly one of `channel`, `user_id`, or `email`.
 *
 * @phpstan-import-type JourneySendNodeToSlackChannelShape from \Courier\Journeys\JourneySendNodeToSlackChannel
 * @phpstan-import-type JourneySendNodeToSlackUserIDShape from \Courier\Journeys\JourneySendNodeToSlackUserID
 * @phpstan-import-type JourneySendNodeToSlackEmailShape from \Courier\Journeys\JourneySendNodeToSlackEmail
 *
 * @phpstan-type JourneySendNodeToSlackVariants = JourneySendNodeToSlackChannel|JourneySendNodeToSlackUserID|JourneySendNodeToSlackEmail
 * @phpstan-type JourneySendNodeToSlackShape = JourneySendNodeToSlackVariants|JourneySendNodeToSlackChannelShape|JourneySendNodeToSlackUserIDShape|JourneySendNodeToSlackEmailShape
 */
final class JourneySendNodeToSlack implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            JourneySendNodeToSlackChannel::class,
            JourneySendNodeToSlackUserID::class,
            JourneySendNodeToSlackEmail::class,
        ];
    }
}
