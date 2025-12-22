<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ListFilter\Operator;
use Courier\ListFilter\Path;

/**
 * @phpstan-type ListFilterShape = array{
 *   operator: Operator|value-of<Operator>,
 *   path: Path|value-of<Path>,
 *   value: string,
 * }
 */
final class ListFilter implements BaseModel
{
    /** @use SdkModel<ListFilterShape> */
    use SdkModel;

    /**
     * Send to users only if they are member of the account.
     *
     * @var value-of<Operator> $operator
     */
    #[Required(enum: Operator::class)]
    public string $operator;

    /** @var value-of<Path> $path */
    #[Required(enum: Path::class)]
    public string $path;

    #[Required]
    public string $value;

    /**
     * `new ListFilter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ListFilter::with(operator: ..., path: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ListFilter)->withOperator(...)->withPath(...)->withValue(...)
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
     * @param Path|value-of<Path> $path
     */
    public static function with(
        Operator|string $operator,
        Path|string $path,
        string $value
    ): self {
        $self = new self;

        $self['operator'] = $operator;
        $self['path'] = $path;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Send to users only if they are member of the account.
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
     * @param Path|value-of<Path> $path
     */
    public function withPath(Path|string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
