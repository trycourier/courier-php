<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Create or Replace a Tenant.
 *
 * @see Courier\Services\TenantsService::update()
 *
 * @phpstan-type TenantUpdateParamsShape = array{
 *   name: string,
 *   brand_id?: string|null,
 *   default_preferences?: DefaultPreferences|null,
 *   parent_tenant_id?: string|null,
 *   properties?: array<string,mixed>|null,
 *   user_profile?: array<string,mixed>|null,
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
    #[Api]
    public string $name;

    /**
     * Brand to be used for the account when one is not specified by the send call.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $brand_id;

    /**
     * Defines the preferences used for the tenant when the user hasn't specified their own.
     */
    #[Api(nullable: true, optional: true)]
    public ?DefaultPreferences $default_preferences;

    /**
     * Tenant's parent id (if any).
     */
    #[Api(nullable: true, optional: true)]
    public ?string $parent_tenant_id;

    /**
     * Arbitrary properties accessible to a template.
     *
     * @var array<string,mixed>|null $properties
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $properties;

    /**
     * A user profile object merged with user profile on send.
     *
     * @var array<string,mixed>|null $user_profile
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $user_profile;

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
     * @param array<string,mixed>|null $properties
     * @param array<string,mixed>|null $user_profile
     */
    public static function with(
        string $name,
        ?string $brand_id = null,
        ?DefaultPreferences $default_preferences = null,
        ?string $parent_tenant_id = null,
        ?array $properties = null,
        ?array $user_profile = null,
    ): self {
        $obj = new self;

        $obj->name = $name;

        null !== $brand_id && $obj->brand_id = $brand_id;
        null !== $default_preferences && $obj->default_preferences = $default_preferences;
        null !== $parent_tenant_id && $obj->parent_tenant_id = $parent_tenant_id;
        null !== $properties && $obj->properties = $properties;
        null !== $user_profile && $obj->user_profile = $user_profile;

        return $obj;
    }

    /**
     * Name of the tenant.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Brand to be used for the account when one is not specified by the send call.
     */
    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj->brand_id = $brandID;

        return $obj;
    }

    /**
     * Defines the preferences used for the tenant when the user hasn't specified their own.
     */
    public function withDefaultPreferences(
        ?DefaultPreferences $defaultPreferences
    ): self {
        $obj = clone $this;
        $obj->default_preferences = $defaultPreferences;

        return $obj;
    }

    /**
     * Tenant's parent id (if any).
     */
    public function withParentTenantID(?string $parentTenantID): self
    {
        $obj = clone $this;
        $obj->parent_tenant_id = $parentTenantID;

        return $obj;
    }

    /**
     * Arbitrary properties accessible to a template.
     *
     * @param array<string,mixed>|null $properties
     */
    public function withProperties(?array $properties): self
    {
        $obj = clone $this;
        $obj->properties = $properties;

        return $obj;
    }

    /**
     * A user profile object merged with user profile on send.
     *
     * @param array<string,mixed>|null $userProfile
     */
    public function withUserProfile(?array $userProfile): self
    {
        $obj = clone $this;
        $obj->user_profile = $userProfile;

        return $obj;
    }
}
