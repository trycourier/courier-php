<?php

declare(strict_types=1);

namespace Courier\Tenants\Preferences\Items;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Remove Default Preferences For Topic.
 *
 * @see Courier\Services\Tenants\Preferences\ItemsService::delete()
 *
 * @phpstan-type ItemDeleteParamsShape = array{tenant_id: string}
 */
final class ItemDeleteParams implements BaseModel
{
    /** @use SdkModel<ItemDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $tenant_id;

    /**
     * `new ItemDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemDeleteParams::with(tenant_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemDeleteParams)->withTenantID(...)
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
     */
    public static function with(string $tenant_id): self
    {
        $obj = new self;

        $obj->tenant_id = $tenant_id;

        return $obj;
    }

    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenant_id = $tenantID;

        return $obj;
    }
}
