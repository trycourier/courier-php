<?php

namespace Courier\Messages\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\Paging;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ListMessagesResponse extends JsonSerializableType
{
    /**
     * @var Paging $paging Paging information for the result set.
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @var array<MessageDetails> $results An array of messages with their details.
     */
    #[JsonProperty('results'), ArrayType([MessageDetails::class])]
    public array $results;

    /**
     * @param array{
     *   paging: Paging,
     *   results: array<MessageDetails>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paging = $values['paging'];
        $this->results = $values['results'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
