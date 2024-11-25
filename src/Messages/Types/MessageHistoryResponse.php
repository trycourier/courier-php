<?php

namespace Courier\Messages\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class MessageHistoryResponse extends JsonSerializableType
{
    /**
     * @var array<array<string, mixed>> $results
     */
    #[JsonProperty('results'), ArrayType([['string' => 'mixed']])]
    public array $results;

    /**
     * @param array{
     *   results: array<array<string, mixed>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->results = $values['results'];
    }
}
