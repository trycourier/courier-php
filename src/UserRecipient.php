<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\UserRecipient\Preferences;

/**
 * @phpstan-type UserRecipientShape = array{
 *   account_id?: string|null,
 *   context?: MessageContext|null,
 *   data?: array<string,mixed>|null,
 *   email?: string|null,
 *   list_id?: string|null,
 *   locale?: string|null,
 *   phone_number?: string|null,
 *   preferences?: Preferences|null,
 *   tenant_id?: string|null,
 *   user_id?: string|null,
 * }
 */
final class UserRecipient implements BaseModel
{
    /** @use SdkModel<UserRecipientShape> */
    use SdkModel;

    /**
     * Deprecated - Use `tenant_id` instead.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $account_id;

    /**
     * Context such as tenant_id to send the notification with.
     */
    #[Api(nullable: true, optional: true)]
    public ?MessageContext $context;

    /** @var array<string,mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /**
     * The user's email address.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $email;

    /**
     * The id of the list to send the message to.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $list_id;

    /**
     * The user's preferred ISO 639-1 language code.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $locale;

    /**
     * The user's phone number.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $phone_number;

    #[Api(nullable: true, optional: true)]
    public ?Preferences $preferences;

    /**
     * The id of the tenant the user is associated with.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tenant_id;

    /**
     * The user's unique identifier. Typically, this will match the user id of a user in your system.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $user_id;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $data
     */
    public static function with(
        ?string $account_id = null,
        ?MessageContext $context = null,
        ?array $data = null,
        ?string $email = null,
        ?string $list_id = null,
        ?string $locale = null,
        ?string $phone_number = null,
        ?Preferences $preferences = null,
        ?string $tenant_id = null,
        ?string $user_id = null,
    ): self {
        $obj = new self;

        null !== $account_id && $obj->account_id = $account_id;
        null !== $context && $obj->context = $context;
        null !== $data && $obj->data = $data;
        null !== $email && $obj->email = $email;
        null !== $list_id && $obj->list_id = $list_id;
        null !== $locale && $obj->locale = $locale;
        null !== $phone_number && $obj->phone_number = $phone_number;
        null !== $preferences && $obj->preferences = $preferences;
        null !== $tenant_id && $obj->tenant_id = $tenant_id;
        null !== $user_id && $obj->user_id = $user_id;

        return $obj;
    }

    /**
     * Deprecated - Use `tenant_id` instead.
     */
    public function withAccountID(?string $accountID): self
    {
        $obj = clone $this;
        $obj->account_id = $accountID;

        return $obj;
    }

    /**
     * Context such as tenant_id to send the notification with.
     */
    public function withContext(?MessageContext $context): self
    {
        $obj = clone $this;
        $obj->context = $context;

        return $obj;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * The user's email address.
     */
    public function withEmail(?string $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }

    /**
     * The id of the list to send the message to.
     */
    public function withListID(?string $listID): self
    {
        $obj = clone $this;
        $obj->list_id = $listID;

        return $obj;
    }

    /**
     * The user's preferred ISO 639-1 language code.
     */
    public function withLocale(?string $locale): self
    {
        $obj = clone $this;
        $obj->locale = $locale;

        return $obj;
    }

    /**
     * The user's phone number.
     */
    public function withPhoneNumber(?string $phoneNumber): self
    {
        $obj = clone $this;
        $obj->phone_number = $phoneNumber;

        return $obj;
    }

    public function withPreferences(?Preferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }

    /**
     * The id of the tenant the user is associated with.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenant_id = $tenantID;

        return $obj;
    }

    /**
     * The user's unique identifier. Typically, this will match the user id of a user in your system.
     */
    public function withUserID(?string $userID): self
    {
        $obj = clone $this;
        $obj->user_id = $userID;

        return $obj;
    }
}
