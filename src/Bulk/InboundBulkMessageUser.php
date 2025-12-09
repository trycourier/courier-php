<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageContext;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;
use Courier\UserRecipient;
use Courier\UserRecipient\Preferences;

/**
 * @phpstan-type InboundBulkMessageUserShape = array{
 *   data?: mixed,
 *   preferences?: RecipientPreferences|null,
 *   profile?: mixed,
 *   recipient?: string|null,
 *   to?: UserRecipient|null,
 * }
 */
final class InboundBulkMessageUser implements BaseModel
{
    /** @use SdkModel<InboundBulkMessageUserShape> */
    use SdkModel;

    #[Optional]
    public mixed $data;

    #[Optional(nullable: true)]
    public ?RecipientPreferences $preferences;

    #[Optional]
    public mixed $profile;

    #[Optional(nullable: true)]
    public ?string $recipient;

    #[Optional(nullable: true)]
    public ?UserRecipient $to;

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
     * @param UserRecipient|array{
     *   accountID?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   listID?: string|null,
     *   locale?: string|null,
     *   phoneNumber?: string|null,
     *   preferences?: Preferences|null,
     *   tenantID?: string|null,
     *   userID?: string|null,
     * }|null $to
     */
    public static function with(
        mixed $data = null,
        RecipientPreferences|array|null $preferences = null,
        mixed $profile = null,
        ?string $recipient = null,
        UserRecipient|array|null $to = null,
    ): self {
        $self = new self;

        null !== $data && $self['data'] = $data;
        null !== $preferences && $self['preferences'] = $preferences;
        null !== $profile && $self['profile'] = $profile;
        null !== $recipient && $self['recipient'] = $recipient;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    public function withData(mixed $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

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

    public function withProfile(mixed $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    /**
     * @param UserRecipient|array{
     *   accountID?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   listID?: string|null,
     *   locale?: string|null,
     *   phoneNumber?: string|null,
     *   preferences?: Preferences|null,
     *   tenantID?: string|null,
     *   userID?: string|null,
     * }|null $to
     */
    public function withTo(UserRecipient|array|null $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
