<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates\TemplateCreateParams\Notification;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalNode;
use Courier\Journeys\Templates\TemplateCreateParams\Notification\Content\Version;

/**
 * @phpstan-import-type ElementalNodeVariants from \Courier\ElementalNode
 * @phpstan-import-type ElementalNodeShape from \Courier\ElementalNode
 *
 * @phpstan-type ContentShape = array{
 *   elements: list<ElementalNodeShape>, version: Version|value-of<Version>
 * }
 */
final class Content implements BaseModel
{
    /** @use SdkModel<ContentShape> */
    use SdkModel;

    /** @var list<ElementalNodeVariants> $elements */
    #[Required(list: ElementalNode::class)]
    public array $elements;

    /** @var value-of<Version> $version */
    #[Required(enum: Version::class)]
    public string $version;

    /**
     * `new Content()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Content::with(elements: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Content)->withElements(...)->withVersion(...)
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
     * @param Version|value-of<Version> $version
     */
    public static function with(array $elements, Version|string $version): self
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
     * @param Version|value-of<Version> $version
     */
    public function withVersion(Version|string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
