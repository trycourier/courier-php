<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsChannelID;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsChannelName;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsConversationID;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsEmail;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsUserID;

final class MsTeams implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
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
