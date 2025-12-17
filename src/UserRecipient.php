<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\UserRecipient\Preferences;

/**
 * @phpstan-import-type MessageContextShape from \Courier\MessageContext
 * @phpstan-import-type PreferencesShape from \Courier\UserRecipient\Preferences
 *
 * @phpstan-type UserRecipientShape = array{
 *   accountID?: string|null,
 *   context?: null|MessageContext|MessageContextShape,
 *   data?: array<string,mixed>|null,
 *   email?: string|null,
 *   listID?: string|null,
 *   locale?: string|null,
 *   phoneNumber?: string|null,
 *   preferences?: null|Preferences|PreferencesShape,
 *   tenantID?: string|null,
 *   userID?: string|null,
 * }
 */
final class UserRecipient implements BaseModel
{
    /** @use SdkModel<UserRecipientShape> */
    use SdkModel;

    /**
     * Deprecated - Use `tenant_id` instead.
     */
    #[Optional('account_id', nullable: true)]
    public ?string $accountID;

    /**
     * Context such as tenant_id to send the notification with.
     */
    #[Optional(nullable: true)]
    public ?MessageContext $context;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    /**
     * The user's email address.
     */
    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * The id of the list to send the message to.
     */
    #[Optional('list_id', nullable: true)]
    public ?string $listID;

    /**
     * The user's preferred ISO 639-1 language code.
     */
    #[Optional(nullable: true)]
    public ?string $locale;

    /**
     * The user's phone number.
     */
    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

    #[Optional(nullable: true)]
    public ?Preferences $preferences;

    /**
     * The id of the tenant the user is associated with.
     */
    #[Optional('tenant_id', nullable: true)]
    public ?string $tenantID;

    /**
     * The user's unique identifier. Typically, this will match the user id of a user in your system.
     */
    #[Optional('user_id', nullable: true)]
    public ?string $userID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param MessageContextShape|null $context
     * @param array<string,mixed>|null $data
     * @param PreferencesShape|null $preferences
     */
    public static function with(
        ?string $accountID = null,
        MessageContext|array|null $context = null,
        ?array $data = null,
        ?string $email = null,
        ?string $listID = null,
        ?string $locale = null,
        ?string $phoneNumber = null,
        Preferences|array|null $preferences = null,
        ?string $tenantID = null,
        ?string $userID = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $context && $self['context'] = $context;
        null !== $data && $self['data'] = $data;
        null !== $email && $self['email'] = $email;
        null !== $listID && $self['listID'] = $listID;
        null !== $locale && $self['locale'] = $locale;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $preferences && $self['preferences'] = $preferences;
        null !== $tenantID && $self['tenantID'] = $tenantID;
        null !== $userID && $self['userID'] = $userID;

        return $self;
    }

    /**
     * Deprecated - Use `tenant_id` instead.
     */
    public function withAccountID(?string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Context such as tenant_id to send the notification with.
     *
     * @param MessageContextShape|null $context
     */
    public function withContext(MessageContext|array|null $context): self
    {
        $self = clone $this;
        $self['context'] = $context;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The user's email address.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The id of the list to send the message to.
     */
    public function withListID(?string $listID): self
    {
        $self = clone $this;
        $self['listID'] = $listID;

        return $self;
    }

    /**
     * The user's preferred ISO 639-1 language code.
     */
    public function withLocale(?string $locale): self
    {
        $self = clone $this;
        $self['locale'] = $locale;

        return $self;
    }

    /**
     * The user's phone number.
     */
    public function withPhoneNumber(?string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * @param PreferencesShape|null $preferences
     */
    public function withPreferences(Preferences|array|null $preferences): self
    {
        $self = clone $this;
        $self['preferences'] = $preferences;

        return $self;
    }

    /**
     * The id of the tenant the user is associated with.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * The user's unique identifier. Typically, this will match the user id of a user in your system.
     */
    public function withUserID(?string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
