<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent\Block\Locale;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type NotificationContentHierarchyShape = array{
 *   children?: string|null, parent?: string|null
 * }
 */
final class NotificationContentHierarchy implements BaseModel
{
    /** @use SdkModel<NotificationContentHierarchyShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $children;

    #[Optional(nullable: true)]
    public ?string $parent;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $children = null,
        ?string $parent = null
    ): self {
        $self = new self;

        null !== $children && $self['children'] = $children;
        null !== $parent && $self['parent'] = $parent;

        return $self;
    }

    public function withChildren(?string $children): self
    {
        $self = clone $this;
        $self['children'] = $children;

        return $self;
    }

    public function withParent(?string $parent): self
    {
        $self = clone $this;
        $self['parent'] = $parent;

        return $self;
    }
}
