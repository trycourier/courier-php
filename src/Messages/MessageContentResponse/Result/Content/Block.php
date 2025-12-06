<?php

declare(strict_types=1);

namespace Courier\Messages\MessageContentResponse\Result\Content;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BlockShape = array{text: string, type: string}
 */
final class Block implements BaseModel
{
    /** @use SdkModel<BlockShape> */
    use SdkModel;

    /**
     * The block text of the rendered message block.
     */
    #[Api]
    public string $text;

    /**
     * The block type of the rendered message block.
     */
    #[Api]
    public string $type;

    /**
     * `new Block()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Block::with(text: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Block)->withText(...)->withType(...)
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
    public static function with(string $text, string $type): self
    {
        $obj = new self;

        $obj['text'] = $text;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * The block text of the rendered message block.
     */
    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj['text'] = $text;

        return $obj;
    }

    /**
     * The block type of the rendered message block.
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }
}
