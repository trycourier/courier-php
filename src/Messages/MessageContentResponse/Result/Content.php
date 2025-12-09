<?php

declare(strict_types=1);

namespace Courier\Messages\MessageContentResponse\Result;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Messages\MessageContentResponse\Result\Content\Block;

/**
 * Content details of the rendered message.
 *
 * @phpstan-type ContentShape = array{
 *   blocks: list<Block>,
 *   body: string,
 *   html: string,
 *   subject: string,
 *   text: string,
 *   title: string,
 * }
 */
final class Content implements BaseModel
{
    /** @use SdkModel<ContentShape> */
    use SdkModel;

    /**
     * The blocks of the rendered message.
     *
     * @var list<Block> $blocks
     */
    #[Required(list: Block::class)]
    public array $blocks;

    /**
     * The body of the rendered message.
     */
    #[Required]
    public string $body;

    /**
     * The html content of the rendered message.
     */
    #[Required]
    public string $html;

    /**
     * The subject of the rendered message.
     */
    #[Required]
    public string $subject;

    /**
     * The text of the rendered message.
     */
    #[Required]
    public string $text;

    /**
     * The title of the rendered message.
     */
    #[Required]
    public string $title;

    /**
     * `new Content()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Content::with(
     *   blocks: ..., body: ..., html: ..., subject: ..., text: ..., title: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Content)
     *   ->withBlocks(...)
     *   ->withBody(...)
     *   ->withHTML(...)
     *   ->withSubject(...)
     *   ->withText(...)
     *   ->withTitle(...)
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
     * @param list<Block|array{text: string, type: string}> $blocks
     */
    public static function with(
        array $blocks,
        string $body,
        string $html,
        string $subject,
        string $text,
        string $title,
    ): self {
        $self = new self;

        $self['blocks'] = $blocks;
        $self['body'] = $body;
        $self['html'] = $html;
        $self['subject'] = $subject;
        $self['text'] = $text;
        $self['title'] = $title;

        return $self;
    }

    /**
     * The blocks of the rendered message.
     *
     * @param list<Block|array{text: string, type: string}> $blocks
     */
    public function withBlocks(array $blocks): self
    {
        $self = clone $this;
        $self['blocks'] = $blocks;

        return $self;
    }

    /**
     * The body of the rendered message.
     */
    public function withBody(string $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }

    /**
     * The html content of the rendered message.
     */
    public function withHTML(string $html): self
    {
        $self = clone $this;
        $self['html'] = $html;

        return $self;
    }

    /**
     * The subject of the rendered message.
     */
    public function withSubject(string $subject): self
    {
        $self = clone $this;
        $self['subject'] = $subject;

        return $self;
    }

    /**
     * The text of the rendered message.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * The title of the rendered message.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
