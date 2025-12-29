<?php

declare(strict_types=1);

namespace Courier\Users\Tenants;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Removes a user from the supplied tenant.
 *
 * @see Courier\Services\Users\TenantsService::removeSingle()
 *
 * @phpstan-type TenantRemoveSingleParamsShape = array{userID: string}
 */
final class TenantRemoveSingleParams implements BaseModel
{
    /** @use SdkModel<TenantRemoveSingleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
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
        $self = new self;

        $self['userID'] = $userID;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
