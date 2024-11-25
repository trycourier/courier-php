<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\UserRecipientType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class UserRecipient extends JsonSerializableType
{
    use UserRecipientType;

    /**
     * @var ?string $accountId Use `tenant_id` instad.
     */
    #[JsonProperty('account_id')]
    public ?string $accountId;

    /**
     * @var ?MessageContext $context Context information such as tenant_id to send the notification with.
     */
    #[JsonProperty('context')]
    public ?MessageContext $context;

    /**
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    public ?array $data;

    /**
     * @var ?string $email
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?string $locale The user's preferred ISO 639-1 language code.
     */
    #[JsonProperty('locale')]
    public ?string $locale;

    /**
     * @var ?string $userId
     */
    #[JsonProperty('user_id')]
    public ?string $userId;

    /**
     * @var ?string $phoneNumber
     */
    #[JsonProperty('phone_number')]
    public ?string $phoneNumber;

    /**
     * @var ?IProfilePreferences $preferences
     */
    #[JsonProperty('preferences')]
    public ?IProfilePreferences $preferences;

    /**
     * @var ?string $tenantId An id of a tenant, [see tenants api docs](https://www.courier.com/docs/reference/tenants).
    Will load brand, default preferences and any other base context data associated with this tenant.
     */
    #[JsonProperty('tenant_id')]
    public ?string $tenantId;

    /**
     * @param array{
     *   accountId?: ?string,
     *   context?: ?MessageContext,
     *   data?: ?array<string, mixed>,
     *   email?: ?string,
     *   locale?: ?string,
     *   userId?: ?string,
     *   phoneNumber?: ?string,
     *   preferences?: ?IProfilePreferences,
     *   tenantId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountId = $values['accountId'] ?? null;
        $this->context = $values['context'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->locale = $values['locale'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->preferences = $values['preferences'] ?? null;
        $this->tenantId = $values['tenantId'] ?? null;
    }
}
