<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Recipient\Preferences;

/**
 * @phpstan-type recipient_alias = array{
 *   accountID?: string|null,
 *   context?: MessageContext|null,
 *   data?: array<string, mixed>|null,
 *   email?: string|null,
 *   locale?: string|null,
 *   phoneNumber?: string|null,
 *   preferences?: Preferences|null,
 *   tenantID?: string|null,
 *   userID?: string|null,
 * }
 */
final class Recipient implements BaseModel
{
    /** @use SdkModel<recipient_alias> */
    use SdkModel;

    /**
     * Deprecated - Use `tenant_id` instead.
     */
    #[Api('account_id', nullable: true, optional: true)]
    public ?string $accountID;

    /**
     * Context such as tenant_id to send the notification with.
     */
    #[Api(nullable: true, optional: true)]
    public ?MessageContext $context;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /**
     * The user's email address.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $email;

    /**
     * The user's preferred ISO 639-1 language code.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $locale;

    /**
     * The user's phone number.
     */
    #[Api('phone_number', nullable: true, optional: true)]
    public ?string $phoneNumber;

    #[Api(nullable: true, optional: true)]
    public ?Preferences $preferences;

    /**
     * The id of the tenant the user is associated with.
     */
    #[Api('tenant_id', nullable: true, optional: true)]
    public ?string $tenantID;

    /**
     * The user's unique identifier. Typically, this will match the user id of a user in your system.
     */
    #[Api('user_id', nullable: true, optional: true)]
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
     * @param array<string, mixed>|null $data
     */
    public static function with(
        ?string $accountID = null,
        ?MessageContext $context = null,
        ?array $data = null,
        ?string $email = null,
        ?string $locale = null,
        ?string $phoneNumber = null,
        ?Preferences $preferences = null,
        ?string $tenantID = null,
        ?string $userID = null,
    ): self {
        $obj = new self;

        null !== $accountID && $obj->accountID = $accountID;
        null !== $context && $obj->context = $context;
        null !== $data && $obj->data = $data;
        null !== $email && $obj->email = $email;
        null !== $locale && $obj->locale = $locale;
        null !== $phoneNumber && $obj->phoneNumber = $phoneNumber;
        null !== $preferences && $obj->preferences = $preferences;
        null !== $tenantID && $obj->tenantID = $tenantID;
        null !== $userID && $obj->userID = $userID;

        return $obj;
    }

    /**
     * Deprecated - Use `tenant_id` instead.
     */
    public function withAccountID(?string $accountID): self
    {
        $obj = clone $this;
        $obj->accountID = $accountID;

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
     * @param array<string, mixed>|null $data
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
        $obj->phoneNumber = $phoneNumber;

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
        $obj->tenantID = $tenantID;

        return $obj;
    }

    /**
     * The user's unique identifier. Typically, this will match the user id of a user in your system.
     */
    public function withUserID(?string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }
}
