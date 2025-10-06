<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationContent\Block\Locale;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type notification_content_hierarchy = array{
 *   children?: string|null, parent1?: string|null
 * }
 */
final class NotificationContentHierarchy implements BaseModel
{
    /** @use SdkModel<notification_content_hierarchy> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $children;

    #[Api(nullable: true, optional: true)]
    public ?string $parent1;

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
        ?string $parent1 = null
    ): self {
        $obj = new self;

        null !== $children && $obj->children = $children;
        null !== $parent1 && $obj->parent1 = $parent1;

        return $obj;
    }

    public function withChildren(?string $children): self
    {
        $obj = clone $this;
        $obj->children = $children;

        return $obj;
    }

    public function withParent(?string $parent1): self
    {
        $obj = clone $this;
        $obj->parent1 = $parent1;

        return $obj;
    }
}
