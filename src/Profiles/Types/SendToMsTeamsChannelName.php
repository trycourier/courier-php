<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Traits\MsTeamsBaseProperties;
use Courier\Core\Json\JsonProperty;

class SendToMsTeamsChannelName extends JsonSerializableType
{
    use MsTeamsBaseProperties;

    /**
     * @var string $channelName
     */
    #[JsonProperty('channel_name')]
    public string $channelName;

    /**
     * @var string $teamId
     */
    #[JsonProperty('team_id')]
    public string $teamId;

    /**
     * @param array{
     *   channelName: string,
     *   teamId: string,
     *   tenantId: string,
     *   serviceUrl: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channelName = $values['channelName'];
        $this->teamId = $values['teamId'];
        $this->tenantId = $values['tenantId'];
        $this->serviceUrl = $values['serviceUrl'];
    }
}
