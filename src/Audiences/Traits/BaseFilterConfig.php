<?php

namespace Courier\Audiences\Traits;

use Courier\Audiences\Types\ComparisonOperator;
use Courier\Audiences\Types\LogicalOperator;
use Courier\Core\Json\JsonProperty;

/**
 * @property (
 *    value-of<ComparisonOperator>
 *   |value-of<LogicalOperator>
 * ) $operator
 */
trait BaseFilterConfig
{
    /**
     * @var (
     *    value-of<ComparisonOperator>
     *   |value-of<LogicalOperator>
     * ) $operator The operator to use for filtering
     */
    #[JsonProperty('operator')]
    public string $operator;
}
