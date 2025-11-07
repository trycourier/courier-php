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
 * @see Courier\Tenants\Preferences\Items->delete
 *
 * @phpstan-type ItemDeleteParamsShape = array{tenantID: string}
 */
final class ItemDeleteParams implements BaseModel
{
    /** @use SdkModel<ItemDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $tenantID;

    /**
     * `new ItemDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemDeleteParams::with(tenantID: ...)
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
    public static function with(string $tenantID): self
    {
        $obj = new self;

        $obj->tenantID = $tenantID;

        return $obj;
    }

    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }
}
