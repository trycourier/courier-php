<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;

/**
 * @phpstan-import-type RecipientPreferencesShape from \Courier\RecipientPreferences
 *
 * @phpstan-type PutSubscriptionsRecipientShape = array{
 *   recipientID: string,
 *   preferences?: null|RecipientPreferences|RecipientPreferencesShape,
 * }
 */
final class PutSubscriptionsRecipient implements BaseModel
{
    /** @use SdkModel<PutSubscriptionsRecipientShape> */
    use SdkModel;

    #[Required('recipientId')]
    public string $recipientID;

    #[Optional(nullable: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new PutSubscriptionsRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PutSubscriptionsRecipient::with(recipientID: ...)
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
     * @param RecipientPreferencesShape|null $preferences
     */
    public static function with(
        string $recipientID,
        RecipientPreferences|array|null $preferences = null
    ): self {
        $self = new self;

        $self['recipientID'] = $recipientID;

        null !== $preferences && $self['preferences'] = $preferences;

        return $self;
    }

    public function withRecipientID(string $recipientID): self
    {
        $self = clone $this;
        $self['recipientID'] = $recipientID;

        return $self;
    }

    /**
     * @param RecipientPreferencesShape|null $preferences
     */
    public function withPreferences(
        RecipientPreferences|array|null $preferences
    ): self {
        $self = clone $this;
        $self['preferences'] = $preferences;

        return $self;
    }
}
