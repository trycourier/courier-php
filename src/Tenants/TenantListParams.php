<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get a List of Tenants.
 *
 * @see Courier\Services\TenantsService::list()
 *
 * @phpstan-type TenantListParamsShape = array{
 *   cursor?: string|null, limit?: int|null, parent_tenant_id?: string|null
 * }
 */
final class TenantListParams implements BaseModel
{
    /** @use SdkModel<TenantListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Continue the pagination with the next cursor.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    /**
     * The number of tenants to return
     * (defaults to 20, maximum value of 100).
     */
    #[Api(nullable: true, optional: true)]
    public ?int $limit;

    /**
     * Filter the list of tenants by parent_id.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $parent_tenant_id;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $parent_tenant_id = null
    ): self {
        $obj = new self;

        null !== $cursor && $obj->cursor = $cursor;
        null !== $limit && $obj->limit = $limit;
        null !== $parent_tenant_id && $obj->parent_tenant_id = $parent_tenant_id;

        return $obj;
    }

    /**
     * Continue the pagination with the next cursor.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * The number of tenants to return
     * (defaults to 20, maximum value of 100).
     */
    public function withLimit(?int $limit): self
    {
        $obj = clone $this;
        $obj->limit = $limit;

        return $obj;
    }

    /**
     * Filter the list of tenants by parent_id.
     */
    public function withParentTenantID(?string $parentTenantID): self
    {
        $obj = clone $this;
        $obj->parent_tenant_id = $parentTenantID;

        return $obj;
    }
}
