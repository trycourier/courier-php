<?php

declare(strict_types=1);

namespace Courier\Messages\MessageContentResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Messages\MessageContentResponse\Result\Content;
use Courier\Messages\MessageContentResponse\Result\Content\Block;

/**
 * @phpstan-type ResultShape = array{
 *   channel: string, channelID: string, content: Content
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * The channel used for rendering the message.
     */
    #[Required]
    public string $channel;

    /**
     * The ID of channel used for rendering the message.
     */
    #[Required('channel_id')]
    public string $channelID;

    /**
     * Content details of the rendered message.
     */
    #[Required]
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
        string $channelID,
        Content|array $content
    ): self {
        $self = new self;

        $self['channel'] = $channel;
        $self['channelID'] = $channelID;
        $self['content'] = $content;

        return $self;
    }

    /**
     * The channel used for rendering the message.
     */
    public function withChannel(string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    /**
     * The ID of channel used for rendering the message.
     */
    public function withChannelID(string $channelID): self
    {
        $self = clone $this;
        $self['channelID'] = $channelID;

        return $self;
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
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }
}
