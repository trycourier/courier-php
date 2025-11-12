<?php

declare(strict_types=1);

namespace Courier\Users\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Removes a user from the supplied tenant.
 *
 * @see Courier\Users\Tenants->removeSingle
 *
 * @phpstan-type TenantRemoveSingleParamsShape = array{user_id: string}
 */
final class TenantRemoveSingleParams implements BaseModel
{
    /** @use SdkModel<TenantRemoveSingleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $user_id;

    /**
     * `new TenantRemoveSingleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantRemoveSingleParams::with(user_id: ...)
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
    public static function with(string $user_id): self
    {
        $obj = new self;

        $obj->user_id = $user_id;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->user_id = $userID;

        return $obj;
    }
}
