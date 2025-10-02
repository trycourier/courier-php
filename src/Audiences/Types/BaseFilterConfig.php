<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BaseFilterConfig extends JsonSerializableType
{
    /**
     * @var (
     *    value-of<ComparisonOperator>
     *   |value-of<LogicalOperator>
     * ) $operator The operator to use for filtering
     */
    #[JsonProperty('operator')]
    public string $operator;

    /**
     * @param array{
     *   operator: (
     *    value-of<ComparisonOperator>
     *   |value-of<LogicalOperator>
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->operator = $values['operator'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
