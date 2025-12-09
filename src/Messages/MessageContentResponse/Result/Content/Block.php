<?php

declare(strict_types=1);

namespace Courier\Messages\MessageContentResponse\Result\Content;

use Courier\Core\Attributes\Required;
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
    #[Required]
    public string $text;

    /**
     * The block type of the rendered message block.
     */
    #[Required]
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
        $self = new self;

        $self['text'] = $text;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The block text of the rendered message block.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * The block type of the rendered message block.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
