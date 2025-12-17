<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;
use Courier\UserRecipient;

/**
 * @phpstan-import-type RecipientPreferencesShape from \Courier\RecipientPreferences
 * @phpstan-import-type UserRecipientShape from \Courier\UserRecipient
 *
 * @phpstan-type InboundBulkMessageUserShape = array{
 *   data?: mixed,
 *   preferences?: null|RecipientPreferences|RecipientPreferencesShape,
 *   profile?: array<string,mixed>|null,
 *   recipient?: string|null,
 *   to?: null|UserRecipient|UserRecipientShape,
 * }
 */
final class InboundBulkMessageUser implements BaseModel
{
    /** @use SdkModel<InboundBulkMessageUserShape> */
    use SdkModel;

    /**
     * User-specific data that will be merged with message.data.
     */
    #[Optional]
    public mixed $data;

    #[Optional(nullable: true)]
    public ?RecipientPreferences $preferences;

    /**
     * User profile information. For email-based bulk jobs, `profile.email` is required
     * for provider routing to determine if the message can be delivered. The email
     * address should be provided here rather than in `to.email`.
     *
     * @var array<string,mixed>|null $profile
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $profile;

    /**
     * User ID (legacy field, use profile or to.user_id instead).
     */
    #[Optional(nullable: true)]
    public ?string $recipient;

    /**
     * Optional recipient information. Note: For email provider routing, use
     * `profile.email` instead of `to.email`. The `to` field is primarily used
     * for recipient identification and data merging.
     */
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
     * @param RecipientPreferencesShape|null $preferences
     * @param array<string,mixed>|null $profile
     * @param UserRecipientShape|null $to
     */
    public static function with(
        mixed $data = null,
        RecipientPreferences|array|null $preferences = null,
        ?array $profile = null,
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

    /**
     * User-specific data that will be merged with message.data.
     */
    public function withData(mixed $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

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

    /**
     * User profile information. For email-based bulk jobs, `profile.email` is required
     * for provider routing to determine if the message can be delivered. The email
     * address should be provided here rather than in `to.email`.
     *
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * User ID (legacy field, use profile or to.user_id instead).
     */
    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    /**
     * Optional recipient information. Note: For email provider routing, use
     * `profile.email` instead of `to.email`. The `to` field is primarily used
     * for recipient identification and data merging.
     *
     * @param UserRecipientShape|null $to
     */
    public function withTo(UserRecipient|array|null $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
