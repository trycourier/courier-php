<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ListPatternRecipientType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ListPatternRecipient extends JsonSerializableType
{
    use ListPatternRecipientType;

    /**
     * @var ?string $listPattern
     */
    #[JsonProperty('list_pattern')]
    public ?string $listPattern;

    /**
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    public ?array $data;

    /**
     * @param array{
     *   listPattern?: ?string,
     *   data?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->listPattern = $values['listPattern'] ?? null;
        $this->data = $values['data'] ?? null;
    }
}
