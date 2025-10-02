<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ListRecipientType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ListRecipient extends JsonSerializableType
{
    use ListRecipientType;

    /**
     * @var ?string $listId
     */
    #[JsonProperty('list_id')]
    public ?string $listId;

    /**
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    public ?array $data;

    /**
     * @var ?array<ListFilter> $filters
     */
    #[JsonProperty('filters'), ArrayType([ListFilter::class])]
    public ?array $filters;

    /**
     * @param array{
     *   listId?: ?string,
     *   data?: ?array<string, mixed>,
     *   filters?: ?array<ListFilter>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->listId = $values['listId'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->filters = $values['filters'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
