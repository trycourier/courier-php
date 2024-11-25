<?php

namespace Courier\Messages\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class RenderedMessageContent extends JsonSerializableType
{
    /**
     * @var string $html The html content of the rendered message.
     */
    #[JsonProperty('html')]
    public string $html;

    /**
     * @var string $title The title of the rendered message.
     */
    #[JsonProperty('title')]
    public string $title;

    /**
     * @var string $body The body of the rendered message.
     */
    #[JsonProperty('body')]
    public string $body;

    /**
     * @var string $subject The subject of the rendered message.
     */
    #[JsonProperty('subject')]
    public string $subject;

    /**
     * @var string $text The text of the rendered message.
     */
    #[JsonProperty('text')]
    public string $text;

    /**
     * @var array<RenderedMessageBlock> $blocks The blocks of the rendered message.
     */
    #[JsonProperty('blocks'), ArrayType([RenderedMessageBlock::class])]
    public array $blocks;

    /**
     * @param array{
     *   html: string,
     *   title: string,
     *   body: string,
     *   subject: string,
     *   text: string,
     *   blocks: array<RenderedMessageBlock>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->html = $values['html'];
        $this->title = $values['title'];
        $this->body = $values['body'];
        $this->subject = $values['subject'];
        $this->text = $values['text'];
        $this->blocks = $values['blocks'];
    }
}
