<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationPutContentParams;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalNode;
use Courier\Notifications\NotificationPutContentParams\Content\Scope;

/**
 * Elemental content payload. The server defaults `version` when omitted.
 *
 * @phpstan-import-type ElementalNodeVariants from \Courier\ElementalNode
 * @phpstan-import-type ElementalNodeShape from \Courier\ElementalNode
 *
 * @phpstan-type ContentShape = array{
 *   elements: list<ElementalNodeShape>,
 *   scope?: null|Scope|value-of<Scope>,
 *   version?: string|null,
 * }
 */
final class Content implements BaseModel
{
    /** @use SdkModel<ContentShape> */
    use SdkModel;

    /** @var list<ElementalNodeVariants> $elements */
    #[Required(list: ElementalNode::class)]
    public array $elements;

    /**
     * How template variables read the data sent with the message. Under `strict`, data fields are read only through the `data.` prefix, as in `{{data.name}}`. Under `default`, `data` is spread onto the root, so `{{name}}` resolves and `{{data.name}}` renders as an empty string. This request replaces the stored content, so omitting `scope` resets it to `default`.
     *
     * @var value-of<Scope>|null $scope
     */
    #[Optional(enum: Scope::class)]
    public ?string $scope;

    /**
     * Content version identifier (e.g., `2022-01-01`). Optional; server defaults when omitted.
     */
    #[Optional]
    public ?string $version;

    /**
     * `new Content()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Content::with(elements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Content)->withElements(...)
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
        Scope|string|null $scope = null,
        ?string $version = null
    ): self {
        $self = new self;

        $self['elements'] = $elements;

        null !== $scope && $self['scope'] = $scope;
        null !== $version && $self['version'] = $version;

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
     * How template variables read the data sent with the message. Under `strict`, data fields are read only through the `data.` prefix, as in `{{data.name}}`. Under `default`, `data` is spread onto the root, so `{{name}}` resolves and `{{data.name}}` renders as an empty string. This request replaces the stored content, so omitting `scope` resets it to `default`.
     *
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * Content version identifier (e.g., `2022-01-01`). Optional; server defaults when omitted.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
