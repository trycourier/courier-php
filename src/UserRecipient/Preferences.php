<?php

declare(strict_types=1);

namespace Courier\UserRecipient;

use Courier\ChannelPreference;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Preference;
use Courier\Preference\Source;
use Courier\PreferenceStatus;
use Courier\Rule;

/**
 * @phpstan-type PreferencesShape = array{
 *   notifications: array<string,Preference>,
 *   categories?: array<string,Preference>|null,
 *   templateID?: string|null,
 * }
 */
final class Preferences implements BaseModel
{
    /** @use SdkModel<PreferencesShape> */
    use SdkModel;

    /** @var array<string,Preference> $notifications */
    #[Required(map: Preference::class)]
    public array $notifications;

    /** @var array<string,Preference>|null $categories */
    #[Optional(map: Preference::class, nullable: true)]
    public ?array $categories;

    #[Optional('templateId', nullable: true)]
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
     * @param array<string,Preference|array{
     *   status: value-of<PreferenceStatus>,
     *   channelPreferences?: list<ChannelPreference>|null,
     *   rules?: list<Rule>|null,
     *   source?: value-of<Source>|null,
     * }> $notifications
     * @param array<string,Preference|array{
     *   status: value-of<PreferenceStatus>,
     *   channelPreferences?: list<ChannelPreference>|null,
     *   rules?: list<Rule>|null,
     *   source?: value-of<Source>|null,
     * }>|null $categories
     */
    public static function with(
        array $notifications,
        ?array $categories = null,
        ?string $templateID = null
    ): self {
        $obj = new self;

        $obj['notifications'] = $notifications;

        null !== $categories && $obj['categories'] = $categories;
        null !== $templateID && $obj['templateID'] = $templateID;

        return $obj;
    }

    /**
     * @param array<string,Preference|array{
     *   status: value-of<PreferenceStatus>,
     *   channelPreferences?: list<ChannelPreference>|null,
     *   rules?: list<Rule>|null,
     *   source?: value-of<Source>|null,
     * }> $notifications
     */
    public function withNotifications(array $notifications): self
    {
        $obj = clone $this;
        $obj['notifications'] = $notifications;

        return $obj;
    }

    /**
     * @param array<string,Preference|array{
     *   status: value-of<PreferenceStatus>,
     *   channelPreferences?: list<ChannelPreference>|null,
     *   rules?: list<Rule>|null,
     *   source?: value-of<Source>|null,
     * }>|null $categories
     */
    public function withCategories(?array $categories): self
    {
        $obj = clone $this;
        $obj['categories'] = $categories;

        return $obj;
    }

    public function withTemplateID(?string $templateID): self
    {
        $obj = clone $this;
        $obj['templateID'] = $templateID;

        return $obj;
    }
}
