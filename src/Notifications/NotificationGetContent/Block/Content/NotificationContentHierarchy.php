<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent\Block\Content;

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
        $obj = new self;

        null !== $children && $obj['children'] = $children;
        null !== $parent && $obj['parent'] = $parent;

        return $obj;
    }

    public function withChildren(?string $children): self
    {
        $obj = clone $this;
        $obj['children'] = $children;

        return $obj;
    }

    public function withParent(?string $parent): self
    {
        $obj = clone $this;
        $obj['parent'] = $parent;

        return $obj;
    }
}
