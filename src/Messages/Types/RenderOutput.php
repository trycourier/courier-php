<?php

namespace Courier\Messages\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class RenderOutput extends JsonSerializableType
{
    /**
     * @var string $channel The channel used for rendering the message.
     */
    #[JsonProperty('channel')]
    public string $channel;

    /**
     * @var string $channelId The ID of channel used for rendering the message.
     */
    #[JsonProperty('channel_id')]
    public string $channelId;

    /**
     * @var RenderedMessageContent $content Content details of the rendered message.
     */
    #[JsonProperty('content')]
    public RenderedMessageContent $content;

    /**
     * @param array{
     *   channel: string,
     *   channelId: string,
     *   content: RenderedMessageContent,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channel = $values['channel'];
        $this->channelId = $values['channelId'];
        $this->content = $values['content'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
