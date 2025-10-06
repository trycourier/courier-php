<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\FilterConfig\UnionMember0;
use Courier\Audiences\NestedFilterConfig\Operator;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type nested_filter_config = array{
 *   operator: value-of<Operator>, rules: list<UnionMember0|NestedFilterConfig>
 * }
 */
final class NestedFilterConfig implements BaseModel
{
    /** @use SdkModel<nested_filter_config> */
    use SdkModel;

    /**
     * The operator to use for filtering.
     *
     * @var value-of<Operator> $operator
     */
    #[Api(enum: Operator::class)]
    public string $operator;

    /** @var list<UnionMember0|NestedFilterConfig> $rules */
    #[Api(list: FilterConfig::class)]
    public array $rules;

    /**
     * `new NestedFilterConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NestedFilterConfig::with(operator: ..., rules: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NestedFilterConfig)->withOperator(...)->withRules(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Operator|value-of<Operator> $operator
     * @param list<UnionMember0|NestedFilterConfig> $rules
     */
    public static function with(Operator|string $operator, array $rules): self
    {
        $obj = new self;

        $obj['operator'] = $operator;
        $obj->rules = $rules;

        return $obj;
    }

    /**
     * The operator to use for filtering.
     *
     * @param Operator|value-of<Operator> $operator
     */
    public function withOperator(Operator|string $operator): self
    {
        $obj = clone $this;
        $obj['operator'] = $operator;

        return $obj;
    }

    /**
     * @param list<UnionMember0|NestedFilterConfig> $rules
     */
    public function withRules(array $rules): self
    {
        $obj = clone $this;
        $obj->rules = $rules;

        return $obj;
    }
}
