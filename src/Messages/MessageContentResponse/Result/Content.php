<?php

declare(strict_types=1);

namespace Courier\Messages\MessageContentResponse\Result;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Messages\MessageContentResponse\Result\Content\Block;

/**
 * Content details of the rendered message.
 *
 * @phpstan-type content_alias = array{
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
    /** @use SdkModel<content_alias> */
    use SdkModel;

    /**
     * The blocks of the rendered message.
     *
     * @var list<Block> $blocks
     */
    #[Api(list: Block::class)]
    public array $blocks;

    /**
     * The body of the rendered message.
     */
    #[Api]
    public string $body;

    /**
     * The html content of the rendered message.
     */
    #[Api]
    public string $html;

    /**
     * The subject of the rendered message.
     */
    #[Api]
    public string $subject;

    /**
     * The text of the rendered message.
     */
    #[Api]
    public string $text;

    /**
     * The title of the rendered message.
     */
    #[Api]
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
     * @param list<Block> $blocks
     */
    public static function with(
        array $blocks,
        string $body,
        string $html,
        string $subject,
        string $text,
        string $title,
    ): self {
        $obj = new self;

        $obj->blocks = $blocks;
        $obj->body = $body;
        $obj->html = $html;
        $obj->subject = $subject;
        $obj->text = $text;
        $obj->title = $title;

        return $obj;
    }

    /**
     * The blocks of the rendered message.
     *
     * @param list<Block> $blocks
     */
    public function withBlocks(array $blocks): self
    {
        $obj = clone $this;
        $obj->blocks = $blocks;

        return $obj;
    }

    /**
     * The body of the rendered message.
     */
    public function withBody(string $body): self
    {
        $obj = clone $this;
        $obj->body = $body;

        return $obj;
    }

    /**
     * The html content of the rendered message.
     */
    public function withHTML(string $html): self
    {
        $obj = clone $this;
        $obj->html = $html;

        return $obj;
    }

    /**
     * The subject of the rendered message.
     */
    public function withSubject(string $subject): self
    {
        $obj = clone $this;
        $obj->subject = $subject;

        return $obj;
    }

    /**
     * The text of the rendered message.
     */
    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj->text = $text;

        return $obj;
    }

    /**
     * The title of the rendered message.
     */
    public function withTitle(string $title): self
    {
        $obj = clone $this;
        $obj->title = $title;

        return $obj;
    }
}
