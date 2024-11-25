<?php

namespace Courier\Tenants\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Tenants\Types\DefaultPreferences;
use Courier\Core\Types\ArrayType;

class TenantCreateOrReplaceParams extends JsonSerializableType
{
    /**
     * @var string $name Name of the tenant.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?string $parentTenantId Tenant's parent id (if any).
     */
    #[JsonProperty('parent_tenant_id')]
    public ?string $parentTenantId;

    /**
     * @var ?DefaultPreferences $defaultPreferences Defines the preferences used for the tenant when the user hasn't specified their own.
     */
    #[JsonProperty('default_preferences')]
    public ?DefaultPreferences $defaultPreferences;

    /**
     * @var ?array<string, mixed> $properties Arbitrary properties accessible to a template.
     */
    #[JsonProperty('properties'), ArrayType(['string' => 'mixed'])]
    public ?array $properties;

    /**
     * @var ?array<string, mixed> $userProfile A user profile object merged with user profile on send.
     */
    #[JsonProperty('user_profile'), ArrayType(['string' => 'mixed'])]
    public ?array $userProfile;

    /**
     * @var ?string $brandId Brand to be used for the account when one is not specified by the send call.
     */
    #[JsonProperty('brand_id')]
    public ?string $brandId;

    /**
     * @param array{
     *   name: string,
     *   parentTenantId?: ?string,
     *   defaultPreferences?: ?DefaultPreferences,
     *   properties?: ?array<string, mixed>,
     *   userProfile?: ?array<string, mixed>,
     *   brandId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->parentTenantId = $values['parentTenantId'] ?? null;
        $this->defaultPreferences = $values['defaultPreferences'] ?? null;
        $this->properties = $values['properties'] ?? null;
        $this->userProfile = $values['userProfile'] ?? null;
        $this->brandId = $values['brandId'] ?? null;
    }
}
