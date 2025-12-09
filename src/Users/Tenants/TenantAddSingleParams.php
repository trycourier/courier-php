<?php

declare(strict_types=1);

namespace Courier\Users\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
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
 * @see Courier\Services\Users\TenantsService::addSingle()
 *
 * @phpstan-type TenantAddSingleParamsShape = array{
 *   userID: string, profile?: array<string,mixed>|null
 * }
 */
final class TenantAddSingleParams implements BaseModel
{
    /** @use SdkModel<TenantAddSingleParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

    /** @var array<string,mixed>|null $profile */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $profile;

    /**
     * `new TenantAddSingleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantAddSingleParams::with(userID: ...)
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
    public static function with(string $userID, ?array $profile = null): self
    {
        $self = new self;

        $self['userID'] = $userID;

        null !== $profile && $self['profile'] = $profile;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }
}
