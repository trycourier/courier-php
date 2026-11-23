<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent\Scope;

/**
 * @phpstan-import-type ElementalNodeVariants from \Courier\ElementalNode
 * @phpstan-import-type ElementalNodeShape from \Courier\ElementalNode
 *
 * @phpstan-type ElementalContentShape = array{
 *   elements: list<ElementalNodeShape>,
 *   version: string,
 *   scope?: null|Scope|value-of<Scope>,
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
     * How template variables read the data sent with the message. Under `strict`, data fields are read only through the `data.` prefix, as in `{{data.name}}`. Under `default`, `data` is spread onto the root, so `{{name}}` resolves and `{{data.name}}` renders as an empty string. Templates saved in Design Studio are `strict`. When omitted, the content is `default`. A write that replaces a template's content resets it to `default` unless the request sends `scope` again.
     *
     * @var value-of<Scope>|null $scope
     */
    #[Optional(enum: Scope::class)]
    public ?string $scope;

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
     * @param Scope|value-of<Scope>|null $scope
     */
    public static function with(
        array $elements,
        string $version,
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
     * For example, "2022-01-01".
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }

    /**
     * How template variables read the data sent with the message. Under `strict`, data fields are read only through the `data.` prefix, as in `{{data.name}}`. Under `default`, `data` is spread onto the root, so `{{name}}` resolves and `{{data.name}}` renders as an empty string. Templates saved in Design Studio are `strict`. When omitted, the content is `default`. A write that replaces a template's content resets it to `default` unless the request sends `scope` again.
     *
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }
}
