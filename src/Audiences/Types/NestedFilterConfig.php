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
     * @var array<SingleFilterConfig|NestedFilterConfig> $rules
     */
    #[JsonProperty('rules'), ArrayType([new Union(SingleFilterConfig::class, NestedFilterConfig::class)])]
    public array $rules;

    /**
     * @param array{
     *   rules: array<SingleFilterConfig|NestedFilterConfig>,
     *   operator: value-of<ComparisonOperator>|value-of<LogicalOperator>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->rules = $values['rules'];
        $this->operator = $values['operator'];
    }
}
