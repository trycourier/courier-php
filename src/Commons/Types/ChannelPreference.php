<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class ChannelPreference extends JsonSerializableType
{
    /**
     * @var value-of<ChannelClassification> $channel
     */
    #[JsonProperty('channel')]
    public string $channel;

    /**
     * @param array{
     *   channel: value-of<ChannelClassification>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channel = $values['channel'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
