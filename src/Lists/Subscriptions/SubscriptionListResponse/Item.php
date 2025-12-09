<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions\SubscriptionListResponse;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;

/**
 * @phpstan-type ItemShape = array{
 *   recipientID: string,
 *   created?: string|null,
 *   preferences?: RecipientPreferences|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Required('recipientId')]
    public string $recipientID;

    #[Optional(nullable: true)]
    public ?string $created;

    #[Optional(nullable: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(recipientID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)->withRecipientID(...)
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
        string $recipientID,
        ?string $created = null,
        RecipientPreferences|array|null $preferences = null,
    ): self {
        $self = new self;

        $self['recipientID'] = $recipientID;

        null !== $created && $self['created'] = $created;
        null !== $preferences && $self['preferences'] = $preferences;

        return $self;
    }

    public function withRecipientID(string $recipientID): self
    {
        $self = clone $this;
        $self['recipientID'] = $recipientID;

        return $self;
    }

    public function withCreated(?string $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

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
