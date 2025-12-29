<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type SendToMsTeamsUserIDShape from \Courier\SendToMsTeamsUserID
 * @phpstan-import-type SendToMsTeamsEmailShape from \Courier\SendToMsTeamsEmail
 * @phpstan-import-type SendToMsTeamsChannelIDShape from \Courier\SendToMsTeamsChannelID
 * @phpstan-import-type SendToMsTeamsConversationIDShape from \Courier\SendToMsTeamsConversationID
 * @phpstan-import-type SendToMsTeamsChannelNameShape from \Courier\SendToMsTeamsChannelName
 *
 * @phpstan-type MsTeamsShape = SendToMsTeamsUserIDShape|SendToMsTeamsEmailShape|SendToMsTeamsChannelIDShape|SendToMsTeamsConversationIDShape|SendToMsTeamsChannelNameShape
 */
final class MsTeams implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            SendToMsTeamsUserID::class,
            SendToMsTeamsEmail::class,
            SendToMsTeamsChannelID::class,
            SendToMsTeamsConversationID::class,
            SendToMsTeamsChannelName::class,
        ];
    }
}
