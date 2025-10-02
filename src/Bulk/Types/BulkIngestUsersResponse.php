<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class BulkIngestUsersResponse extends JsonSerializableType
{
    /**
     * @var int $total
     */
    #[JsonProperty('total')]
    public int $total;

    /**
     * @var ?array<BulkIngestError> $errors
     */
    #[JsonProperty('errors'), ArrayType([BulkIngestError::class])]
    public ?array $errors;

    /**
     * @param array{
     *   total: int,
     *   errors?: ?array<BulkIngestError>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->total = $values['total'];
        $this->errors = $values['errors'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
