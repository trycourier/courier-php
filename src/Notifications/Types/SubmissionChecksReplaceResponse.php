<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class SubmissionChecksReplaceResponse extends JsonSerializableType
{
    /**
     * @var array<Check> $checks
     */
    #[JsonProperty('checks'), ArrayType([Check::class])]
    public array $checks;

    /**
     * @param array{
     *   checks: array<Check>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->checks = $values['checks'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
