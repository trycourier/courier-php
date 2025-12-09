<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\UserRecipient\Preferences;

/**
 * @phpstan-type UserRecipientShape = array{
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
     * @param MessageContext|array{tenantID?: string|null}|null $context
     * @param array<string,mixed>|null $data
     * @param Preferences|array{
     *   notifications: array<string,Preference>,
     *   categories?: array<string,Preference>|null,
     *   templateID?: string|null,
     * }|null $preferences
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
        $obj = new self;

        null !== $accountID && $obj['accountID'] = $accountID;
        null !== $context && $obj['context'] = $context;
        null !== $data && $obj['data'] = $data;
        null !== $email && $obj['email'] = $email;
        null !== $listID && $obj['listID'] = $listID;
        null !== $locale && $obj['locale'] = $locale;
        null !== $phoneNumber && $obj['phoneNumber'] = $phoneNumber;
        null !== $preferences && $obj['preferences'] = $preferences;
        null !== $tenantID && $obj['tenantID'] = $tenantID;
        null !== $userID && $obj['userID'] = $userID;

        return $obj;
    }

    /**
     * Deprecated - Use `tenant_id` instead.
     */
    public function withAccountID(?string $accountID): self
    {
        $obj = clone $this;
        $obj['accountID'] = $accountID;

        return $obj;
    }

    /**
     * Context such as tenant_id to send the notification with.
     *
     * @param MessageContext|array{tenantID?: string|null}|null $context
     */
    public function withContext(MessageContext|array|null $context): self
    {
        $obj = clone $this;
        $obj['context'] = $context;

        return $obj;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }

    /**
     * The user's email address.
     */
    public function withEmail(?string $email): self
    {
        $obj = clone $this;
        $obj['email'] = $email;

        return $obj;
    }

    /**
     * The id of the list to send the message to.
     */
    public function withListID(?string $listID): self
    {
        $obj = clone $this;
        $obj['listID'] = $listID;

        return $obj;
    }

    /**
     * The user's preferred ISO 639-1 language code.
     */
    public function withLocale(?string $locale): self
    {
        $obj = clone $this;
        $obj['locale'] = $locale;

        return $obj;
    }

    /**
     * The user's phone number.
     */
    public function withPhoneNumber(?string $phoneNumber): self
    {
        $obj = clone $this;
        $obj['phoneNumber'] = $phoneNumber;

        return $obj;
    }

    /**
     * @param Preferences|array{
     *   notifications: array<string,Preference>,
     *   categories?: array<string,Preference>|null,
     *   templateID?: string|null,
     * }|null $preferences
     */
    public function withPreferences(Preferences|array|null $preferences): self
    {
        $obj = clone $this;
        $obj['preferences'] = $preferences;

        return $obj;
    }

    /**
     * The id of the tenant the user is associated with.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj['tenantID'] = $tenantID;

        return $obj;
    }

    /**
     * The user's unique identifier. Typically, this will match the user id of a user in your system.
     */
    public function withUserID(?string $userID): self
    {
        $obj = clone $this;
        $obj['userID'] = $userID;

        return $obj;
    }
}
