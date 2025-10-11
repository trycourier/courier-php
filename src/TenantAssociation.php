<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\TenantAssociation\Type;

/**
 * @phpstan-type tenant_association = array{
 *   tenantID: string,
 *   profile?: array<string, mixed>|null,
 *   type?: value-of<Type>|null,
 *   userID?: string|null,
 * }
 */
final class TenantAssociation implements BaseModel
{
    /** @use SdkModel<tenant_association> */
    use SdkModel;

    /**
     * Tenant ID for the association between tenant and user.
     */
    #[Api('tenant_id')]
    public string $tenantID;

    /**
     * Additional metadata to be applied to a user profile when used in a tenant context.
     *
     * @var array<string, mixed>|null $profile
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $profile;

    /** @var value-of<Type>|null $type */
    #[Api(enum: Type::class, nullable: true, optional: true)]
    public ?string $type;

    /**
     * User ID for the association between tenant and user.
     */
    #[Api('user_id', nullable: true, optional: true)]
    public ?string $userID;

    /**
     * `new TenantAssociation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantAssociation::with(tenantID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenantAssociation)->withTenantID(...)
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
     * @param array<string, mixed>|null $profile
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $tenantID,
        ?array $profile = null,
        Type|string|null $type = null,
        ?string $userID = null,
    ): self {
        $obj = new self;

        $obj->tenantID = $tenantID;

        null !== $profile && $obj->profile = $profile;
        null !== $type && $obj['type'] = $type;
        null !== $userID && $obj->userID = $userID;

        return $obj;
    }

    /**
     * Tenant ID for the association between tenant and user.
     */
    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }

    /**
     * Additional metadata to be applied to a user profile when used in a tenant context.
     *
     * @param array<string, mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }

    /**
     * @param Type|value-of<Type>|null $type
     */
    public function withType(Type|string|null $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * User ID for the association between tenant and user.
     */
    public function withUserID(?string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }
}
