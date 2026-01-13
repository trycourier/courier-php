<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Filter that contains an array of FilterConfig items.
 *
 * @phpstan-type FilterShape = array{filters: list<mixed>}
 */
final class Filter implements BaseModel
{
    /** @use SdkModel<FilterShape> */
    use SdkModel;

    /** @var list<mixed> $filters */
    #[Required(list: FilterConfig::class)]
    public array $filters;

    /**
     * `new Filter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Filter::with(filters: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Filter)->withFilters(...)
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
     */
    public static function with(array $filters): self
    {
        $self = new self;

        $self['filters'] = $filters;

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
}
