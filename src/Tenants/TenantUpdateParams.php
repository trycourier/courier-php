<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\DefaultPreferences;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new TenantUpdateParams); // set properties as needed
 * $client->tenants->update(...$params->toArray());
 * ```
 * Create or Replace a Tenant.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->tenants->update(...$params->toArray());`
 *
 * @see Courier\Tenants->update
 *
 * @phpstan-type tenant_update_params = array{
 *   name: string,
 *   brandID?: string|null,
 *   defaultPreferences?: DefaultPreferences|null,
 *   parentTenantID?: string|null,
 *   properties?: array<string, mixed>|null,
 *   userProfile?: array<string, mixed>|null,
 * }
 */
final class TenantUpdateParams implements BaseModel
{
    /** @use SdkModel<tenant_update_params> */
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
    #[Api('brand_id', nullable: true, optional: true)]
    public ?string $brandID;

    /**
     * Defines the preferences used for the tenant when the user hasn't specified their own.
     */
    #[Api('default_preferences', nullable: true, optional: true)]
    public ?DefaultPreferences $defaultPreferences;

    /**
     * Tenant's parent id (if any).
     */
    #[Api('parent_tenant_id', nullable: true, optional: true)]
    public ?string $parentTenantID;

    /**
     * Arbitrary properties accessible to a template.
     *
     * @var array<string, mixed>|null $properties
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $properties;

    /**
     * A user profile object merged with user profile on send.
     *
     * @var array<string, mixed>|null $userProfile
     */
    #[Api('user_profile', map: 'mixed', nullable: true, optional: true)]
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
     * @param array<string, mixed>|null $properties
     * @param array<string, mixed>|null $userProfile
     */
    public static function with(
        string $name,
        ?string $brandID = null,
        ?DefaultPreferences $defaultPreferences = null,
        ?string $parentTenantID = null,
        ?array $properties = null,
        ?array $userProfile = null,
    ): self {
        $obj = new self;

        $obj->name = $name;

        null !== $brandID && $obj->brandID = $brandID;
        null !== $defaultPreferences && $obj->defaultPreferences = $defaultPreferences;
        null !== $parentTenantID && $obj->parentTenantID = $parentTenantID;
        null !== $properties && $obj->properties = $properties;
        null !== $userProfile && $obj->userProfile = $userProfile;

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
        $obj->brandID = $brandID;

        return $obj;
    }

    /**
     * Defines the preferences used for the tenant when the user hasn't specified their own.
     */
    public function withDefaultPreferences(
        ?DefaultPreferences $defaultPreferences
    ): self {
        $obj = clone $this;
        $obj->defaultPreferences = $defaultPreferences;

        return $obj;
    }

    /**
     * Tenant's parent id (if any).
     */
    public function withParentTenantID(?string $parentTenantID): self
    {
        $obj = clone $this;
        $obj->parentTenantID = $parentTenantID;

        return $obj;
    }

    /**
     * Arbitrary properties accessible to a template.
     *
     * @param array<string, mixed>|null $properties
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
     * @param array<string, mixed>|null $userProfile
     */
    public function withUserProfile(?array $userProfile): self
    {
        $obj = clone $this;
        $obj->userProfile = $userProfile;

        return $obj;
    }
}
