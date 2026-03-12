<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ElementalNodeVariants from \Courier\ElementalNode
 * @phpstan-import-type ElementalNodeShape from \Courier\ElementalNode
 *
 * @phpstan-type ElementalContentShape = array{
 *   elements: list<ElementalNodeShape>, version: string
 * }
 */
final class ElementalContent implements BaseModel
{
    /** @use SdkModel<ElementalContentShape> */
    use SdkModel;

    /** @var list<ElementalNodeVariants> $elements */
    #[Required(list: ElementalNode::class)]
    public array $elements;

    /**
     * For example, "2022-01-01".
     */
    #[Required]
    public string $version;

    /**
     * `new ElementalContent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementalContent::with(elements: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementalContent)->withElements(...)->withVersion(...)
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
     * @param list<ElementalNodeShape> $elements
     */
    public static function with(array $elements, string $version): self
    {
        $self = new self;

        $self['elements'] = $elements;
        $self['version'] = $version;

        return $self;
    }

    /**
     * @param list<ElementalNodeShape> $elements
     */
    public function withElements(array $elements): self
    {
        $self = clone $this;
        $self['elements'] = $elements;

        return $self;
    }

    /**
     * For example, "2022-01-01".
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
