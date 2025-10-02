<?php

namespace Courier\Tenants\Requests;

use Courier\Core\Json\JsonSerializableType;

class ListTenantParams extends JsonSerializableType
{
    /**
     * @var ?string $parentTenantId Filter the list of tenants by parent_id
     */
    public ?string $parentTenantId;

    /**
     * The number of tenants to return
     * (defaults to 20, maximum value of 100)
     *
     * @var ?int $limit
     */
    public ?int $limit;

    /**
     * @var ?string $cursor Continue the pagination with the next cursor
     */
    public ?string $cursor;

    /**
     * @param array{
     *   parentTenantId?: ?string,
     *   limit?: ?int,
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->parentTenantId = $values['parentTenantId'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
    }
}
