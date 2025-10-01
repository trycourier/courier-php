<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Lists\Subscriptions\RecipientPreferences\Category;
use Courier\Lists\Subscriptions\RecipientPreferences\Notification;

/**
 * @phpstan-type recipient_preferences = array{
 *   categories?: array<string, Category>|null,
 *   notifications?: array<string, Notification>|null,
 * }
 */
final class RecipientPreferences implements BaseModel
{
    /** @use SdkModel<recipient_preferences> */
    use SdkModel;

    /** @var array<string, Category>|null $categories */
    #[Api(map: Category::class, nullable: true, optional: true)]
    public ?array $categories;

    /** @var array<string, Notification>|null $notifications */
    #[Api(map: Notification::class, nullable: true, optional: true)]
    public ?array $notifications;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, Category>|null $categories
     * @param array<string, Notification>|null $notifications
     */
    public static function with(
        ?array $categories = null,
        ?array $notifications = null
    ): self {
        $obj = new self;

        null !== $categories && $obj->categories = $categories;
        null !== $notifications && $obj->notifications = $notifications;

        return $obj;
    }

    /**
     * @param array<string, Category>|null $categories
     */
    public function withCategories(?array $categories): self
    {
        $obj = clone $this;
        $obj->categories = $categories;

        return $obj;
    }

    /**
     * @param array<string, Notification>|null $notifications
     */
    public function withNotifications(?array $notifications): self
    {
        $obj = clone $this;
        $obj->notifications = $notifications;

        return $obj;
    }
}
