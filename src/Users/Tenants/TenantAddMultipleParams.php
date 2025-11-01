<?php

declare(strict_types=1);

namespace Courier\Users\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\TenantAssociation;

/**
 * This endpoint is used to add a user to
 * multiple tenants in one call.
 * A custom profile can also be supplied for each tenant.
 * This profile will be merged with the user's main
 * profile when sending to the user with that tenant.
 *
 * @see Courier\Users\Tenants->addMultiple
 *
 * @phpstan-type TenantAddMultipleParamsShape = array{
 *   tenants: list<TenantAssociation>
 * }
 */
final class TenantAddMultipleParams implements BaseModel
{
    /** @use SdkModel<TenantAddMultipleParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<TenantAssociation> $tenants */
    #[Api(list: TenantAssociation::class)]
    public array $tenants;

    /**
     * `new TenantAddMultipleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantAddMultipleParams::with(tenants: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenantAddMultipleParams)->withTenants(...)
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
     * @param list<TenantAssociation> $tenants
     */
    public static function with(array $tenants): self
    {
        $obj = new self;

        $obj->tenants = $tenants;

        return $obj;
    }

    /**
     * @param list<TenantAssociation> $tenants
     */
    public function withTenants(array $tenants): self
    {
        $obj = clone $this;
        $obj->tenants = $tenants;

        return $obj;
    }
}
