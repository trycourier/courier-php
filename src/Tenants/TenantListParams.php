<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new TenantListParams); // set properties as needed
 * $client->tenants->list(...$params->toArray());
 * ```
 * Get a List of Tenants.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->tenants->list(...$params->toArray());`
 *
 * @see Courier\Tenants->list
 *
 * @phpstan-type tenant_list_params = array{
 *   cursor?: string|null, limit?: int|null, parentTenantID?: string|null
 * }
 */
final class TenantListParams implements BaseModel
{
    /** @use SdkModel<tenant_list_params> */
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
    public ?string $parentTenantID;

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
        ?string $parentTenantID = null
    ): self {
        $obj = new self;

        null !== $cursor && $obj->cursor = $cursor;
        null !== $limit && $obj->limit = $limit;
        null !== $parentTenantID && $obj->parentTenantID = $parentTenantID;

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
        $obj->parentTenantID = $parentTenantID;

        return $obj;
    }
}
