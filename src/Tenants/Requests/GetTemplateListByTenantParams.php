<?php

namespace Courier\Tenants\Requests;

use Courier\Core\Json\JsonSerializableType;

class GetTemplateListByTenantParams extends JsonSerializableType
{
    /**
     * @var ?int $limit The number of templates to return (defaults to 20, maximum value of 100)
     */
    public ?int $limit;

    /**
     * @var ?string $cursor Continue the pagination with the next cursor
     */
    public ?string $cursor;

    /**
     * @param array{
     *   limit?: ?int,
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->limit = $values['limit'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
    }
}
