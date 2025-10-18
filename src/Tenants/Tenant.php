<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type tenant_alias = array{
 *   id: string,
 *   name: string,
 *   brandID?: string|null,
 *   defaultPreferences?: DefaultPreferences|null,
 *   parentTenantID?: string|null,
 *   properties?: array<string, mixed>|null,
 *   userProfile?: array<string, mixed>|null,
 * }
 */
final class Tenant implements BaseModel, ResponseConverter
{
    /** @use SdkModel<tenant_alias> */
    use SdkModel;

    use SdkResponse;

    /**
     * Id of the tenant.
     */
    #[Api]
    public string $id;

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
     * Defines the preferences used for the account when the user hasn't specified their own.
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
     * `new Tenant()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Tenant::with(id: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Tenant)->withID(...)->withName(...)
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
        string $id,
        string $name,
        ?string $brandID = null,
        ?DefaultPreferences $defaultPreferences = null,
        ?string $parentTenantID = null,
        ?array $properties = null,
        ?array $userProfile = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->name = $name;

        null !== $brandID && $obj->brandID = $brandID;
        null !== $defaultPreferences && $obj->defaultPreferences = $defaultPreferences;
        null !== $parentTenantID && $obj->parentTenantID = $parentTenantID;
        null !== $properties && $obj->properties = $properties;
        null !== $userProfile && $obj->userProfile = $userProfile;

        return $obj;
    }

    /**
     * Id of the tenant.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

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
     * Defines the preferences used for the account when the user hasn't specified their own.
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
