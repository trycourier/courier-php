<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Tenants\DefaultPreferences\Item;

/**
 * @phpstan-type TenantShape = array{
 *   id: string,
 *   name: string,
 *   brand_id?: string|null,
 *   default_preferences?: DefaultPreferences|null,
 *   parent_tenant_id?: string|null,
 *   properties?: array<string,mixed>|null,
 *   user_profile?: array<string,mixed>|null,
 * }
 */
final class Tenant implements BaseModel, ResponseConverter
{
    /** @use SdkModel<TenantShape> */
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
    #[Api(nullable: true, optional: true)]
    public ?string $brand_id;

    /**
     * Defines the preferences used for the account when the user hasn't specified their own.
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
     * @param DefaultPreferences|array{
     *   items?: list<Item>|null
     * }|null $default_preferences
     * @param array<string,mixed>|null $properties
     * @param array<string,mixed>|null $user_profile
     */
    public static function with(
        string $id,
        string $name,
        ?string $brand_id = null,
        DefaultPreferences|array|null $default_preferences = null,
        ?string $parent_tenant_id = null,
        ?array $properties = null,
        ?array $user_profile = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['name'] = $name;

        null !== $brand_id && $obj['brand_id'] = $brand_id;
        null !== $default_preferences && $obj['default_preferences'] = $default_preferences;
        null !== $parent_tenant_id && $obj['parent_tenant_id'] = $parent_tenant_id;
        null !== $properties && $obj['properties'] = $properties;
        null !== $user_profile && $obj['user_profile'] = $user_profile;

        return $obj;
    }

    /**
     * Id of the tenant.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Name of the tenant.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Brand to be used for the account when one is not specified by the send call.
     */
    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    /**
     * Defines the preferences used for the account when the user hasn't specified their own.
     *
     * @param DefaultPreferences|array{
     *   items?: list<Item>|null
     * }|null $defaultPreferences
     */
    public function withDefaultPreferences(
        DefaultPreferences|array|null $defaultPreferences
    ): self {
        $obj = clone $this;
        $obj['default_preferences'] = $defaultPreferences;

        return $obj;
    }

    /**
     * Tenant's parent id (if any).
     */
    public function withParentTenantID(?string $parentTenantID): self
    {
        $obj = clone $this;
        $obj['parent_tenant_id'] = $parentTenantID;

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
        $obj['properties'] = $properties;

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
        $obj['user_profile'] = $userProfile;

        return $obj;
    }
}
