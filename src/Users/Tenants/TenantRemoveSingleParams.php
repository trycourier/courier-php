<?php

declare(strict_types=1);

namespace Courier\Users\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new TenantRemoveSingleParams); // set properties as needed
 * $client->users.tenants->removeSingle(...$params->toArray());
 * ```
 * Removes a user from the supplied tenant.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->users.tenants->removeSingle(...$params->toArray());`
 *
 * @see Courier\Users\Tenants->removeSingle
 *
 * @phpstan-type tenant_remove_single_params = array{userID: string}
 */
final class TenantRemoveSingleParams implements BaseModel
{
    /** @use SdkModel<tenant_remove_single_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $userID;

    /**
     * `new TenantRemoveSingleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantRemoveSingleParams::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenantRemoveSingleParams)->withUserID(...)
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
    public static function with(string $userID): self
    {
        $obj = new self;

        $obj->userID = $userID;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }
}
