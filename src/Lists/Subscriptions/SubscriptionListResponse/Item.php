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
        $obj = new self;

        $obj['recipientID'] = $recipientID;

        null !== $created && $obj['created'] = $created;
        null !== $preferences && $obj['preferences'] = $preferences;

        return $obj;
    }

    public function withRecipientID(string $recipientID): self
    {
        $obj = clone $this;
        $obj['recipientID'] = $recipientID;

        return $obj;
    }

    public function withCreated(?string $created): self
    {
        $obj = clone $this;
        $obj['created'] = $created;

        return $obj;
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
        $obj = clone $this;
        $obj['preferences'] = $preferences;

        return $obj;
    }
}
