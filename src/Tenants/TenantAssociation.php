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
 *   tenantID: string,
 *   profile?: array<string,mixed>|null,
 *   type?: null|Type|value-of<Type>,
 *   userID?: string|null,
 * }
 */
final class TenantAssociation implements BaseModel
{
    /** @use SdkModel<TenantAssociationShape> */
    use SdkModel;

    /**
     * Tenant ID for the association between tenant and user.
     */
    #[Required('tenant_id')]
    public string $tenantID;

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
    #[Optional('user_id', nullable: true)]
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
     * @param array<string,mixed>|null $profile
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $tenantID,
        ?array $profile = null,
        Type|string|null $type = null,
        ?string $userID = null,
    ): self {
        $self = new self;

        $self['tenantID'] = $tenantID;

        null !== $profile && $self['profile'] = $profile;
        null !== $type && $self['type'] = $type;
        null !== $userID && $self['userID'] = $userID;

        return $self;
    }

    /**
     * Tenant ID for the association between tenant and user.
     */
    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * Additional metadata to be applied to a user profile when used in a tenant context.
     *
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * @param Type|value-of<Type>|null $type
     */
    public function withType(Type|string|null $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * User ID for the association between tenant and user.
     */
    public function withUserID(?string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
