<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\NestedFilterConfig\Operator;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type NestedFilterConfigShape = array{
 *   operator: Operator|value-of<Operator>, rules: list<mixed>
 * }
 */
final class NestedFilterConfig implements BaseModel
{
    /** @use SdkModel<NestedFilterConfigShape> */
    use SdkModel;

    /**
     * The operator to use for filtering.
     *
     * @var value-of<Operator> $operator
     */
    #[Required(enum: Operator::class)]
    public string $operator;

    /** @var list<mixed> $rules */
    #[Required(list: FilterConfig::class)]
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
     * @param list<mixed> $rules
     */
    public static function with(Operator|string $operator, array $rules): self
    {
        $self = new self;

        $self['operator'] = $operator;
        $self['rules'] = $rules;

        return $self;
    }

    /**
     * The operator to use for filtering.
     *
     * @param Operator|value-of<Operator> $operator
     */
    public function withOperator(Operator|string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * @param list<mixed> $rules
     */
    public function withRules(array $rules): self
    {
        $self = clone $this;
        $self['rules'] = $rules;

        return $self;
    }
}
