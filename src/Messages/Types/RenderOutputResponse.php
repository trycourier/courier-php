<?php

namespace Courier\Messages\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class RenderOutputResponse extends JsonSerializableType
{
    /**
     * @var array<RenderOutput> $results An array of render output of a previously sent message.
     */
    #[JsonProperty('results'), ArrayType([RenderOutput::class])]
    public array $results;

    /**
     * @param array{
     *   results: array<RenderOutput>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
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
