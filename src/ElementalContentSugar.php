<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Syntactic sugar to provide a fast shorthand for Courier Elemental Blocks.
 *
 * @phpstan-type ElementalContentSugarShape = array{body: string, title: string}
 */
final class ElementalContentSugar implements BaseModel
{
    /** @use SdkModel<ElementalContentSugarShape> */
    use SdkModel;

    /**
     * The text content displayed in the notification.
     */
    #[Required]
    public string $body;

    /**
     * Title/subject displayed by supported channels.
     */
    #[Required]
    public string $title;

    /**
     * `new ElementalContentSugar()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementalContentSugar::with(body: ..., title: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementalContentSugar)->withBody(...)->withTitle(...)
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
    public static function with(string $body, string $title): self
    {
        $obj = new self;

        $obj['body'] = $body;
        $obj['title'] = $title;

        return $obj;
    }

    /**
     * The text content displayed in the notification.
     */
    public function withBody(string $body): self
    {
        $obj = clone $this;
        $obj['body'] = $body;

        return $obj;
    }

    /**
     * Title/subject displayed by supported channels.
     */
    public function withTitle(string $title): self
    {
        $obj = clone $this;
        $obj['title'] = $title;

        return $obj;
    }
}
