<?php

declare(strict_types=1);

namespace Courier\UserRecipient;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Preference;

/**
 * @phpstan-import-type PreferenceShape from \Courier\Preference
 *
 * @phpstan-type PreferencesShape = array{
 *   notifications: array<string,PreferenceShape>,
 *   categories?: array<string,PreferenceShape>|null,
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
     * @param array<string,PreferenceShape> $notifications
     * @param array<string,PreferenceShape>|null $categories
     */
    public static function with(
        array $notifications,
        ?array $categories = null,
        ?string $templateID = null
    ): self {
        $self = new self;

        $self['notifications'] = $notifications;

        null !== $categories && $self['categories'] = $categories;
        null !== $templateID && $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * @param array<string,PreferenceShape> $notifications
     */
    public function withNotifications(array $notifications): self
    {
        $self = clone $this;
        $self['notifications'] = $notifications;

        return $self;
    }

    /**
     * @param array<string,PreferenceShape>|null $categories
     */
    public function withCategories(?array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    public function withTemplateID(?string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }
}
