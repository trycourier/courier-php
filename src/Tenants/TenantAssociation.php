<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\TenantAssociation\Type;

/**
 * @phpstan-type TenantAssociationShape = array{
 *   tenant_id: string,
 *   profile?: array<string,mixed>|null,
 *   type?: value-of<Type>|null,
 *   user_id?: string|null,
 * }
 */
final class TenantAssociation implements BaseModel
{
    /** @use SdkModel<TenantAssociationShape> */
    use SdkModel;

    /**
     * Tenant ID for the association between tenant and user.
     */
    #[Required]
    public string $tenant_id;

    /**
     * Additional metadata to be applied to a user profile when used in a tenant context.
     *
     * @var array<string,mixed>|null $profile
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $profile;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class, nullable: true)]
    public ?string $type;

    /**
     * User ID for the association between tenant and user.
     */
    #[Optional(nullable: true)]
    public ?string $user_id;

    /**
     * `new TenantAssociation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenantAssociation::with(tenant_id: ...)
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
     * @param array<string,mixed>|null $profile
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $tenant_id,
        ?array $profile = null,
        Type|string|null $type = null,
        ?string $user_id = null,
    ): self {
        $obj = new self;

        $obj['tenant_id'] = $tenant_id;

        null !== $profile && $obj['profile'] = $profile;
        null !== $type && $obj['type'] = $type;
        null !== $user_id && $obj['user_id'] = $user_id;

        return $obj;
    }

    /**
     * Tenant ID for the association between tenant and user.
     */
    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj['tenant_id'] = $tenantID;

        return $obj;
    }

    /**
     * Additional metadata to be applied to a user profile when used in a tenant context.
     *
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $obj = clone $this;
        $obj['profile'] = $profile;

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
        $obj['user_id'] = $userID;

        return $obj;
    }
}
