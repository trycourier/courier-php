<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Traits\MsTeamsBaseProperties;
use Courier\Core\Json\JsonProperty;

class SendToMsTeamsChannelId extends JsonSerializableType
{
    use MsTeamsBaseProperties;

    /**
     * @var string $channelId
     */
    #[JsonProperty('channel_id')]
    public string $channelId;

    /**
     * @param array{
     *   tenantId: string,
     *   serviceUrl: string,
     *   channelId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tenantId = $values['tenantId'];
        $this->serviceUrl = $values['serviceUrl'];
        $this->channelId = $values['channelId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
