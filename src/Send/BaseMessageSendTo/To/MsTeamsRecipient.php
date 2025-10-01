<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsChannelID;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsChannelName;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsConversationID;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsEmail;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient\MsTeams\SendToMsTeamsUserID;

/**
 * @phpstan-type ms_teams_recipient = array{
 *   msTeams: send_to_ms_teams_user_id|send_to_ms_teams_email|send_to_ms_teams_channel_id|send_to_ms_teams_conversation_id|send_to_ms_teams_channel_name,
 * }
 */
final class MsTeamsRecipient implements BaseModel
{
    /** @use SdkModel<ms_teams_recipient> */
    use SdkModel;

    #[Api('ms_teams')]
    public SendToMsTeamsUserID|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName $msTeams;

    /**
     * `new MsTeamsRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MsTeamsRecipient::with(msTeams: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MsTeamsRecipient)->withMsTeams(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        SendToMsTeamsUserID|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName $msTeams,
    ): self {
        $obj = new self;

        $obj->msTeams = $msTeams;

        return $obj;
    }

    public function withMsTeams(
        SendToMsTeamsUserID|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName $msTeams,
    ): self {
        $obj = clone $this;
        $obj->msTeams = $msTeams;

        return $obj;
    }
}
