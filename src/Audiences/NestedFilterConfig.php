<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\NestedFilterConfig\Operator;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type NestedFilterConfigShape = array{
 *   filters: list<mixed>, operator: Operator|value-of<Operator>
 * }
 */
final class NestedFilterConfig implements BaseModel
{
    /** @use SdkModel<NestedFilterConfigShape> */
    use SdkModel;

    /** @var list<mixed> $filters */
    #[Required(list: FilterConfig::class)]
    public array $filters;

    /**
     * The operator to use for filtering.
     *
     * @var value-of<Operator> $operator
     */
    #[Required(enum: Operator::class)]
    public string $operator;

    /**
     * `new NestedFilterConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NestedFilterConfig::with(filters: ..., operator: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NestedFilterConfig)->withFilters(...)->withOperator(...)
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
     * @param list<mixed> $filters
     * @param Operator|value-of<Operator> $operator
     */
    public static function with(array $filters, Operator|string $operator): self
    {
        $self = new self;

        $self['filters'] = $filters;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * @param list<mixed> $filters
     */
    public function withFilters(array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

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
}
