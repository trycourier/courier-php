<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyTemplateGetResponse;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalNode;
use Courier\Journeys\JourneyTemplateGetResponse\Content\Scope;
use Courier\Journeys\JourneyTemplateGetResponse\Content\Version;

/**
 * @phpstan-import-type ElementalNodeVariants from \Courier\ElementalNode
 * @phpstan-import-type ElementalNodeShape from \Courier\ElementalNode
 *
 * @phpstan-type ContentShape = array{
 *   elements: list<ElementalNodeShape>,
 *   version: Version|value-of<Version>,
 *   scope?: null|Scope|value-of<Scope>,
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

    /** @var value-of<Scope>|null $scope */
    #[Optional(enum: Scope::class)]
    public ?string $scope;

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
     * @param Scope|value-of<Scope>|null $scope
     */
    public static function with(
        array $elements,
        Version|string $version,
        Scope|string|null $scope = null
    ): self {
        $self = new self;

        $self['elements'] = $elements;
        $self['version'] = $version;

        null !== $scope && $self['scope'] = $scope;

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

    /**
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }
}
