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
 * $params = (new TenantListUsersParams); // set properties as needed
 * $client->tenants->listUsers(...$params->toArray());
 * ```
 * Get Users in Tenant.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->tenants->listUsers(...$params->toArray());`
 *
 * @see Courier\Tenants->listUsers
 *
 * @phpstan-type tenant_list_users_params = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class TenantListUsersParams implements BaseModel
{
    /** @use SdkModel<tenant_list_users_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Continue the pagination with the next cursor.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    /**
     * The number of accounts to return
     * (defaults to 20, maximum value of 100).
     */
    #[Api(nullable: true, optional: true)]
    public ?int $limit;

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
        ?int $limit = null
    ): self {
        $obj = new self;

        null !== $cursor && $obj->cursor = $cursor;
        null !== $limit && $obj->limit = $limit;

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
     * The number of accounts to return
     * (defaults to 20, maximum value of 100).
     */
    public function withLimit(?int $limit): self
    {
        $obj = clone $this;
        $obj->limit = $limit;

        return $obj;
    }
}
