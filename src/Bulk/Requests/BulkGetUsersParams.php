<?php

namespace Courier\Bulk\Requests;

use Courier\Core\Json\JsonSerializableType;

class BulkGetUsersParams extends JsonSerializableType
{
    /**
     * @var ?string $cursor A unique identifier that allows for fetching the next set of users added to the bulk job
     */
    public ?string $cursor;

    /**
     * @param array{
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->cursor = $values['cursor'] ?? null;
    }
}
