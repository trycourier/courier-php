<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\MsTeamsRecipient;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\Recipient\MsTeamsRecipient\MsTeams\SendToMsTeamsChannelID;
use Courier\Send\Recipient\MsTeamsRecipient\MsTeams\SendToMsTeamsChannelName;
use Courier\Send\Recipient\MsTeamsRecipient\MsTeams\SendToMsTeamsConversationID;
use Courier\Send\Recipient\MsTeamsRecipient\MsTeams\SendToMsTeamsEmail;
use Courier\Send\Recipient\MsTeamsRecipient\MsTeams\SendToMsTeamsUserID;

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
