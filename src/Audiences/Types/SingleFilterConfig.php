<?php

namespace Courier\Audiences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Audiences\Traits\BaseFilterConfig;
use Courier\Core\Json\JsonProperty;

/**
 * A single filter to use for filtering
 */
class SingleFilterConfig extends JsonSerializableType
{
    use BaseFilterConfig;

    /**
     * @var string $value The value to use for filtering
     */
    #[JsonProperty('value')]
    public string $value;

    /**
     * @var string $path The attribe name from profile whose value will be operated against the filter value
     */
    #[JsonProperty('path')]
    public string $path;

    /**
     * @param array{
     *   value: string,
     *   path: string,
     *   operator: value-of<ComparisonOperator>|value-of<LogicalOperator>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->value = $values['value'];
        $this->path = $values['path'];
        $this->operator = $values['operator'];
    }
}
