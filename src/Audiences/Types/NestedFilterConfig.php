<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Audiences\Traits\BaseFilterConfig;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Core\Types\Union;

/**
 * The operator to use for filtering
 */
class NestedFilterConfig extends JsonSerializableType
{
    use BaseFilterConfig;

    /**
     * @var array<(
     *    SingleFilterConfig
     *   |NestedFilterConfig
     * )> $rules
     */
    #[JsonProperty('rules'), ArrayType([new Union(SingleFilterConfig::class, NestedFilterConfig::class)])]
    public array $rules;

    /**
     * @param array{
     *   operator: (
     *    value-of<ComparisonOperator>
     *   |value-of<LogicalOperator>
     * ),
     *   rules: array<(
     *    SingleFilterConfig
     *   |NestedFilterConfig
     * )>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->operator = $values['operator'];
        $this->rules = $values['rules'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
