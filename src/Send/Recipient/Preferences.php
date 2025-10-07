<?php

declare(strict_types=1);

namespace Courier\Send\Recipient;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Recipient\Preferences\Category;
use Courier\Send\Recipient\Preferences\Notification;

/**
 * @phpstan-type preferences_alias = array{
 *   notifications: array<string, Notification>,
 *   categories?: array<string, Category>|null,
 *   templateID?: string|null,
 * }
 */
final class Preferences implements BaseModel
{
    /** @use SdkModel<preferences_alias> */
    use SdkModel;

    /** @var array<string, Notification> $notifications */
    #[Api(map: Notification::class)]
    public array $notifications;

    /** @var array<string, Category>|null $categories */
    #[Api(map: Category::class, nullable: true, optional: true)]
    public ?array $categories;

    #[Api('templateId', nullable: true, optional: true)]
    public ?string $templateID;

    /**
     * `new Preferences()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Preferences::with(notifications: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Preferences)->withNotifications(...)
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
     * @param array<string, Notification> $notifications
     * @param array<string, Category>|null $categories
     */
    public static function with(
        array $notifications,
        ?array $categories = null,
        ?string $templateID = null
    ): self {
        $obj = new self;

        $obj->notifications = $notifications;

        null !== $categories && $obj->categories = $categories;
        null !== $templateID && $obj->templateID = $templateID;

        return $obj;
    }

    /**
     * @param array<string, Notification> $notifications
     */
    public function withNotifications(array $notifications): self
    {
        $obj = clone $this;
        $obj->notifications = $notifications;

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

    public function withTemplateID(?string $templateID): self
    {
        $obj = clone $this;
        $obj->templateID = $templateID;

        return $obj;
    }
}
