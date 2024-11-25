<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Traits\SlackBaseProperties;
use Courier\Core\Json\JsonProperty;

class SendToSlackChannel extends JsonSerializableType
{
    use SlackBaseProperties;

    /**
     * @var string $channel
     */
    #[JsonProperty('channel')]
    public string $channel;

    /**
     * @param array{
     *   channel: string,
     *   accessToken: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channel = $values['channel'];
        $this->accessToken = $values['accessToken'];
    }
}
