<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type RecipientPreferencesShape = array{
 *   categories?: array<string,NotificationPreferenceDetails>|null,
 *   notifications?: array<string,NotificationPreferenceDetails>|null,
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
     * @param array<string,NotificationPreferenceDetails|array{
     *   status: value-of<PreferenceStatus>,
     *   channel_preferences?: list<ChannelPreference>|null,
     *   rules?: list<Rule>|null,
     * }>|null $categories
     * @param array<string,NotificationPreferenceDetails|array{
     *   status: value-of<PreferenceStatus>,
     *   channel_preferences?: list<ChannelPreference>|null,
     *   rules?: list<Rule>|null,
     * }>|null $notifications
     */
    public static function with(
        ?array $categories = null,
        ?array $notifications = null
    ): self {
        $obj = new self;

        null !== $categories && $obj['categories'] = $categories;
        null !== $notifications && $obj['notifications'] = $notifications;

        return $obj;
    }

    /**
     * @param array<string,NotificationPreferenceDetails|array{
     *   status: value-of<PreferenceStatus>,
     *   channel_preferences?: list<ChannelPreference>|null,
     *   rules?: list<Rule>|null,
     * }>|null $categories
     */
    public function withCategories(?array $categories): self
    {
        $obj = clone $this;
        $obj['categories'] = $categories;

        return $obj;
    }

    /**
     * @param array<string,NotificationPreferenceDetails|array{
     *   status: value-of<PreferenceStatus>,
     *   channel_preferences?: list<ChannelPreference>|null,
     *   rules?: list<Rule>|null,
     * }>|null $notifications
     */
    public function withNotifications(?array $notifications): self
    {
        $obj = clone $this;
        $obj['notifications'] = $notifications;

        return $obj;
    }
}
