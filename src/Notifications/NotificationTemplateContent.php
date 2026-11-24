<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalNode;

/**
 * Elemental content of a notification template. Template variables read the data sent with the message through the `data.` prefix, as in `{{data.name}}`, and the recipient's profile through `profile.`.
 *
 * @phpstan-import-type ElementalNodeVariants from \Courier\ElementalNode
 * @phpstan-import-type ElementalNodeShape from \Courier\ElementalNode
 *
 * @phpstan-type NotificationTemplateContentShape = array{
 *   elements: list<ElementalNodeShape>, version: string
 * }
 */
final class NotificationTemplateContent implements BaseModel
{
    /** @use SdkModel<NotificationTemplateContentShape> */
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
     * `new NotificationTemplateContent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplateContent::with(elements: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationTemplateContent)->withElements(...)->withVersion(...)
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
