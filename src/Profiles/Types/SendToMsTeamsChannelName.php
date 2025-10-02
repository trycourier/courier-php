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
     *   tenantId: string,
     *   serviceUrl: string,
     *   channelName: string,
     *   teamId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tenantId = $values['tenantId'];
        $this->serviceUrl = $values['serviceUrl'];
        $this->channelName = $values['channelName'];
        $this->teamId = $values['teamId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
