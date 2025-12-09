<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;

/**
 * @phpstan-type SubscribeToListsRequestItemShape = array{
 *   listID: string, preferences?: RecipientPreferences|null
 * }
 */
final class SubscribeToListsRequestItem implements BaseModel
{
    /** @use SdkModel<SubscribeToListsRequestItemShape> */
    use SdkModel;

    #[Required('listId')]
    public string $listID;

    #[Optional(nullable: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new SubscribeToListsRequestItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscribeToListsRequestItem::with(listID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscribeToListsRequestItem)->withListID(...)
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
     * @param RecipientPreferences|array{
     *   categories?: array<string,NotificationPreferenceDetails>|null,
     *   notifications?: array<string,NotificationPreferenceDetails>|null,
     * }|null $preferences
     */
    public static function with(
        string $listID,
        RecipientPreferences|array|null $preferences = null
    ): self {
        $self = new self;

        $self['listID'] = $listID;

        null !== $preferences && $self['preferences'] = $preferences;

        return $self;
    }

    public function withListID(string $listID): self
    {
        $self = clone $this;
        $self['listID'] = $listID;

        return $self;
    }

    /**
     * @param RecipientPreferences|array{
     *   categories?: array<string,NotificationPreferenceDetails>|null,
     *   notifications?: array<string,NotificationPreferenceDetails>|null,
     * }|null $preferences
     */
    public function withPreferences(
        RecipientPreferences|array|null $preferences
    ): self {
        $self = clone $this;
        $self['preferences'] = $preferences;

        return $self;
    }
}
