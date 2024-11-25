<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class SendToChannel extends JsonSerializableType
{
    /**
     * @var string $channelId
     */
    #[JsonProperty('channel_id')]
    public string $channelId;

    /**
     * @param array{
     *   channelId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channelId = $values['channelId'];
    }
}
