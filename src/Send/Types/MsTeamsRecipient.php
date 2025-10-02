<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Types\SendToMsTeamsUserId;
use Courier\Profiles\Types\SendToMsTeamsEmail;
use Courier\Profiles\Types\SendToMsTeamsChannelId;
use Courier\Profiles\Types\SendToMsTeamsConversationId;
use Courier\Profiles\Types\SendToMsTeamsChannelName;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class MsTeamsRecipient extends JsonSerializableType
{
    /**
     * @var (
     *    SendToMsTeamsUserId
     *   |SendToMsTeamsEmail
     *   |SendToMsTeamsChannelId
     *   |SendToMsTeamsConversationId
     *   |SendToMsTeamsChannelName
     * ) $msTeams
     */
    #[JsonProperty('ms_teams'), Union(SendToMsTeamsUserId::class, SendToMsTeamsEmail::class, SendToMsTeamsChannelId::class, SendToMsTeamsConversationId::class, SendToMsTeamsChannelName::class)]
    public SendToMsTeamsUserId|SendToMsTeamsEmail|SendToMsTeamsChannelId|SendToMsTeamsConversationId|SendToMsTeamsChannelName $msTeams;

    /**
     * @param array{
     *   msTeams: (
     *    SendToMsTeamsUserId
     *   |SendToMsTeamsEmail
     *   |SendToMsTeamsChannelId
     *   |SendToMsTeamsConversationId
     *   |SendToMsTeamsChannelName
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->msTeams = $values['msTeams'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
