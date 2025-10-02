<?php

namespace Courier\Users\Tenants\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * AddUserToSingleTenantsParamsProfile is no longer used for Add a User to a Single Tenant
 */
class AddUserToSingleTenantsParamsProfile extends JsonSerializableType
{
    /**
     * @var string $title
     */
    #[JsonProperty('title')]
    public string $title;

    /**
     * @var string $email Email Address
     */
    #[JsonProperty('email')]
    public string $email;

    /**
     * @var string $phoneNumber A valid phone number
     */
    #[JsonProperty('phone_number')]
    public string $phoneNumber;

    /**
     * @var string $locale The user's preferred ISO 639-1 language code.
     */
    #[JsonProperty('locale')]
    public string $locale;

    /**
     * @var array<string, mixed> $additionalFields Additional provider specific fields may be specified.
     */
    #[JsonProperty('additional_fields'), ArrayType(['string' => 'mixed'])]
    public array $additionalFields;

    /**
     * @param array{
     *   title: string,
     *   email: string,
     *   phoneNumber: string,
     *   locale: string,
     *   additionalFields: array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->title = $values['title'];
        $this->email = $values['email'];
        $this->phoneNumber = $values['phoneNumber'];
        $this->locale = $values['locale'];
        $this->additionalFields = $values['additionalFields'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
