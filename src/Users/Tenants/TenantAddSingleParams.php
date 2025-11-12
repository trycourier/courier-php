<?php

declare(strict_types=1);

namespace Courier\Users\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * This endpoint is used to add a single tenant.
 *
 * A custom profile can also be supplied with the tenant.
 * This profile will be merged with the user's main profile
 * when sending to the user with that tenant.
 *
 * @see Courier\Users\Tenants->addSingle
 *
 * @phpstan-type TenantAddSingleParamsShape = array{
 *   user_id: string, profile?: array<string,mixed>|null
 * }
 */
final class TenantAddSingleParams implements BaseModel
{
    /** @use SdkModel<TenantAddSingleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $user_id;

    /** @var array<string,mixed>|null $profile */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $profile;

    /**
     * `new TenantAddSingleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantAddSingleParams::with(user_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenantAddSingleParams)->withUserID(...)
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
     * @param array<string,mixed>|null $profile
     */
    public static function with(string $user_id, ?array $profile = null): self
    {
        $obj = new self;

        $obj->user_id = $user_id;

        null !== $profile && $obj->profile = $profile;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->user_id = $userID;

        return $obj;
    }

    /**
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }
}
