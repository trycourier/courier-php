<?php

declare(strict_types=1);

namespace Courier\Messages\MessageContentResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Messages\MessageContentResponse\Result\Content;
use Courier\Messages\MessageContentResponse\Result\Content\Block;

/**
 * @phpstan-type ResultShape = array{
 *   channel: string, channel_id: string, content: Content
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * The channel used for rendering the message.
     */
    #[Api]
    public string $channel;

    /**
     * The ID of channel used for rendering the message.
     */
    #[Api]
    public string $channel_id;

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
     * Result::with(channel: ..., channel_id: ..., content: ...)
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
     *
     * @param Content|array{
     *   blocks: list<Block>,
     *   body: string,
     *   html: string,
     *   subject: string,
     *   text: string,
     *   title: string,
     * } $content
     */
    public static function with(
        string $channel,
        string $channel_id,
        Content|array $content
    ): self {
        $obj = new self;

        $obj['channel'] = $channel;
        $obj['channel_id'] = $channel_id;
        $obj['content'] = $content;

        return $obj;
    }

    /**
     * The channel used for rendering the message.
     */
    public function withChannel(string $channel): self
    {
        $obj = clone $this;
        $obj['channel'] = $channel;

        return $obj;
    }

    /**
     * The ID of channel used for rendering the message.
     */
    public function withChannelID(string $channelID): self
    {
        $obj = clone $this;
        $obj['channel_id'] = $channelID;

        return $obj;
    }

    /**
     * Content details of the rendered message.
     *
     * @param Content|array{
     *   blocks: list<Block>,
     *   body: string,
     *   html: string,
     *   subject: string,
     *   text: string,
     *   title: string,
     * } $content
     */
    public function withContent(Content|array $content): self
    {
        $obj = clone $this;
        $obj['content'] = $content;

        return $obj;
    }
}
