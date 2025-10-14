<?php

declare(strict_types=1);

namespace Courier\Tenants\TenantDefaultPreferences\Items;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new ItemDeleteParams); // set properties as needed
 * $client->tenants.tenantDefaultPreferences.items->delete(...$params->toArray());
 * ```
 * Remove Default Preferences For Topic.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->tenants.tenantDefaultPreferences.items->delete(...$params->toArray());`
 *
 * @see Courier\Tenants\TenantDefaultPreferences\Items->delete
 *
 * @phpstan-type item_delete_params = array{tenantID: string}
 */
final class ItemDeleteParams implements BaseModel
{
    /** @use SdkModel<item_delete_params> */
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
