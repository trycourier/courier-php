<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;

/**
 * @phpstan-type PutSubscriptionsRecipientShape = array{
 *   recipientId: string, preferences?: RecipientPreferences|null
 * }
 */
final class PutSubscriptionsRecipient implements BaseModel
{
    /** @use SdkModel<PutSubscriptionsRecipientShape> */
    use SdkModel;

    #[Api]
    public string $recipientId;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new PutSubscriptionsRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PutSubscriptionsRecipient::with(recipientId: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PutSubscriptionsRecipient)->withRecipientID(...)
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
        string $recipientId,
        RecipientPreferences|array|null $preferences = null
    ): self {
        $obj = new self;

        $obj['recipientId'] = $recipientId;

        null !== $preferences && $obj['preferences'] = $preferences;

        return $obj;
    }

    public function withRecipientID(string $recipientID): self
    {
        $obj = clone $this;
        $obj['recipientId'] = $recipientID;

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
