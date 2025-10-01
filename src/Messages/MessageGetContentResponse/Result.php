<?php

declare(strict_types=1);

namespace Courier\Messages\MessageGetContentResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Messages\MessageGetContentResponse\Result\Content;

/**
 * @phpstan-type result_alias = array{
 *   channel: string, channelID: string, content: Content
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<result_alias> */
    use SdkModel;

    /**
     * The channel used for rendering the message.
     */
    #[Api]
    public string $channel;

    /**
     * The ID of channel used for rendering the message.
     */
    #[Api('channel_id')]
    public string $channelID;

    /**
     * Content details of the rendered message.
     */
    #[Api]
    public Content $content;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(channel: ..., channelID: ..., content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)->withChannel(...)->withChannelID(...)->withContent(...)
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
        string $channel,
        string $channelID,
        Content $content
    ): self {
        $obj = new self;

        $obj->channel = $channel;
        $obj->channelID = $channelID;
        $obj->content = $content;

        return $obj;
    }

    /**
     * The channel used for rendering the message.
     */
    public function withChannel(string $channel): self
    {
        $obj = clone $this;
        $obj->channel = $channel;

        return $obj;
    }

    /**
     * The ID of channel used for rendering the message.
     */
    public function withChannelID(string $channelID): self
    {
        $obj = clone $this;
        $obj->channelID = $channelID;

        return $obj;
    }

    /**
     * Content details of the rendered message.
     */
    public function withContent(Content $content): self
    {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }
}
