<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\SingleFilterConfig\Operator;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SingleFilterConfigShape = array{
 *   operator: Operator|value-of<Operator>, path: string, value: string
 * }
 */
final class SingleFilterConfig implements BaseModel
{
    /** @use SdkModel<SingleFilterConfigShape> */
    use SdkModel;

    /**
     * The operator to use for filtering.
     *
     * @var value-of<Operator> $operator
     */
    #[Required(enum: Operator::class)]
    public string $operator;

    /**
     * The attribe name from profile whose value will be operated against the filter value.
     */
    #[Required]
    public string $path;

    /**
     * The value to use for filtering.
     */
    #[Required]
    public string $value;

    /**
     * `new SingleFilterConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SingleFilterConfig::with(operator: ..., path: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SingleFilterConfig)->withOperator(...)->withPath(...)->withValue(...)
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
        $self = new self;

        $self['operator'] = $operator;
        $self['path'] = $path;
        $self['value'] = $value;

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
     * The attribe name from profile whose value will be operated against the filter value.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * The value to use for filtering.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
