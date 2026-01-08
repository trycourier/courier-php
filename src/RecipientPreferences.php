<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type NotificationPreferenceDetailsShape from \Courier\NotificationPreferenceDetails
 *
 * @phpstan-type RecipientPreferencesShape = array{
 *   categories?: array<string,NotificationPreferenceDetails|NotificationPreferenceDetailsShape>|null,
 *   notifications?: array<string,NotificationPreferenceDetails|NotificationPreferenceDetailsShape>|null,
 * }
 */
final class RecipientPreferences implements BaseModel
{
    /** @use SdkModel<RecipientPreferencesShape> */
    use SdkModel;

    /** @var array<string,NotificationPreferenceDetails>|null $categories */
    #[Optional(map: NotificationPreferenceDetails::class, nullable: true)]
    public ?array $categories;

    /** @var array<string,NotificationPreferenceDetails>|null $notifications */
    #[Optional(map: NotificationPreferenceDetails::class, nullable: true)]
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
     * @param array<string,NotificationPreferenceDetails|NotificationPreferenceDetailsShape>|null $categories
     * @param array<string,NotificationPreferenceDetails|NotificationPreferenceDetailsShape>|null $notifications
     */
    public static function with(
        ?array $categories = null,
        ?array $notifications = null
    ): self {
        $self = new self;

        null !== $categories && $self['categories'] = $categories;
        null !== $notifications && $self['notifications'] = $notifications;

        return $self;
    }

    /**
     * @param array<string,NotificationPreferenceDetails|NotificationPreferenceDetailsShape>|null $categories
     */
    public function withCategories(?array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * @param array<string,NotificationPreferenceDetails|NotificationPreferenceDetailsShape>|null $notifications
     */
    public function withNotifications(?array $notifications): self
    {
        $self = clone $this;
        $self['notifications'] = $notifications;

        return $self;
    }
}
