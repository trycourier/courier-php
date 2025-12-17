<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Create or Replace a Tenant.
 *
 * @see Courier\Services\TenantsService::update()
 *
 * @phpstan-import-type DefaultPreferencesShape from \Courier\Tenants\DefaultPreferences
 *
 * @phpstan-type TenantUpdateParamsShape = array{
 *   name: string,
 *   brandID?: string|null,
 *   defaultPreferences?: DefaultPreferencesShape|null,
 *   parentTenantID?: string|null,
 *   properties?: array<string,mixed>|null,
 *   userProfile?: array<string,mixed>|null,
 * }
 */
final class TenantUpdateParams implements BaseModel
{
    /** @use SdkModel<TenantUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Name of the tenant.
     */
    #[Required]
    public string $name;

    /**
     * Brand to be used for the account when one is not specified by the send call.
     */
    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Defines the preferences used for the tenant when the user hasn't specified their own.
     */
    #[Optional('default_preferences', nullable: true)]
    public ?DefaultPreferences $defaultPreferences;

    /**
     * Tenant's parent id (if any).
     */
    #[Optional('parent_tenant_id', nullable: true)]
    public ?string $parentTenantID;

    /**
     * Arbitrary properties accessible to a template.
     *
     * @var array<string,mixed>|null $properties
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $properties;

    /**
     * A user profile object merged with user profile on send.
     *
     * @var array<string,mixed>|null $userProfile
     */
    #[Optional('user_profile', map: 'mixed', nullable: true)]
    public ?array $userProfile;

    /**
     * `new TenantUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantUpdateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenantUpdateParams)->withName(...)
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
     * @param DefaultPreferencesShape|null $defaultPreferences
     * @param array<string,mixed>|null $properties
     * @param array<string,mixed>|null $userProfile
     */
    public static function with(
        string $name,
        ?string $brandID = null,
        DefaultPreferences|array|null $defaultPreferences = null,
        ?string $parentTenantID = null,
        ?array $properties = null,
        ?array $userProfile = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $defaultPreferences && $self['defaultPreferences'] = $defaultPreferences;
        null !== $parentTenantID && $self['parentTenantID'] = $parentTenantID;
        null !== $properties && $self['properties'] = $properties;
        null !== $userProfile && $self['userProfile'] = $userProfile;

        return $self;
    }

    /**
     * Name of the tenant.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Brand to be used for the account when one is not specified by the send call.
     */
    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Defines the preferences used for the tenant when the user hasn't specified their own.
     *
     * @param DefaultPreferencesShape|null $defaultPreferences
     */
    public function withDefaultPreferences(
        DefaultPreferences|array|null $defaultPreferences
    ): self {
        $self = clone $this;
        $self['defaultPreferences'] = $defaultPreferences;

        return $self;
    }

    /**
     * Tenant's parent id (if any).
     */
    public function withParentTenantID(?string $parentTenantID): self
    {
        $self = clone $this;
        $self['parentTenantID'] = $parentTenantID;

        return $self;
    }

    /**
     * Arbitrary properties accessible to a template.
     *
     * @param array<string,mixed>|null $properties
     */
    public function withProperties(?array $properties): self
    {
        $self = clone $this;
        $self['properties'] = $properties;

        return $self;
    }

    /**
     * A user profile object merged with user profile on send.
     *
     * @param array<string,mixed>|null $userProfile
     */
    public function withUserProfile(?array $userProfile): self
    {
        $self = clone $this;
        $self['userProfile'] = $userProfile;

        return $self;
    }
}
