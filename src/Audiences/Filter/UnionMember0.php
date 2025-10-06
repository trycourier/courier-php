<?php

declare(strict_types=1);

namespace Courier\Audiences\Filter;

use Courier\Audiences\Filter\UnionMember0\Operator;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type union_member0 = array{
 *   operator: value-of<Operator>, path: string, value: string
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<union_member0> */
    use SdkModel;

    /**
     * The operator to use for filtering.
     *
     * @var value-of<Operator> $operator
     */
    #[Api(enum: Operator::class)]
    public string $operator;

    /**
     * The attribe name from profile whose value will be operated against the filter value.
     */
    #[Api]
    public string $path;

    /**
     * The value to use for filtering.
     */
    #[Api]
    public string $value;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(operator: ..., path: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)->withOperator(...)->withPath(...)->withValue(...)
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
     */
    public static function with(
        Operator|string $operator,
        string $path,
        string $value
    ): self {
        $obj = new self;

        $obj['operator'] = $operator;
        $obj->path = $path;
        $obj->value = $value;

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
     * The attribe name from profile whose value will be operated against the filter value.
     */
    public function withPath(string $path): self
    {
        $obj = clone $this;
        $obj->path = $path;

        return $obj;
    }

    /**
     * The value to use for filtering.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
