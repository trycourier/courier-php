<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A filter rule that can be either a single condition (with path/value) or a  nested group (with filters array). Use comparison operators (EQ, GT, etc.)  for single conditions, and logical operators (AND, OR) for nested groups.
 *
 * @phpstan-type FilterConfigShape = array{
 *   operator: string,
 *   filters?: list<mixed>|null,
 *   path?: string|null,
 *   value?: string|null,
 * }
 */
final class FilterConfig implements BaseModel
{
    /** @use SdkModel<FilterConfigShape> */
    use SdkModel;

    /**
     * The operator for this filter. Use comparison operators (EQ, GT, LT, GTE, LTE,  NEQ, EXISTS, INCLUDES, STARTS_WITH, ENDS_WITH, IS_BEFORE, IS_AFTER, OMIT) for  single conditions, or logical operators (AND, OR) for nested filter groups.
     */
    #[Required]
    public string $operator;

    /**
     * Nested filter rules to combine with AND/OR. Required for nested filter groups, not used for single filter conditions.
     *
     * @var list<mixed>|null $filters
     */
    #[Optional(list: FilterConfig::class)]
    public ?array $filters;

    /**
     * The attribute path from the user profile to filter on. Required for single  filter conditions, not used for nested filter groups.
     */
    #[Optional]
    public ?string $path;

    /**
     * The value to compare against. Required for single filter conditions,  not used for nested filter groups.
     */
    #[Optional]
    public ?string $value;

    /**
     * `new FilterConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FilterConfig::with(operator: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FilterConfig)->withOperator(...)
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
     * @param list<mixed>|null $filters
     */
    public static function with(
        string $operator,
        ?array $filters = null,
        ?string $path = null,
        ?string $value = null,
    ): self {
        $self = new self;

        $self['operator'] = $operator;

        null !== $filters && $self['filters'] = $filters;
        null !== $path && $self['path'] = $path;
        null !== $value && $self['value'] = $value;

        return $self;
    }

    /**
     * The operator for this filter. Use comparison operators (EQ, GT, LT, GTE, LTE,  NEQ, EXISTS, INCLUDES, STARTS_WITH, ENDS_WITH, IS_BEFORE, IS_AFTER, OMIT) for  single conditions, or logical operators (AND, OR) for nested filter groups.
     */
    public function withOperator(string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * Nested filter rules to combine with AND/OR. Required for nested filter groups, not used for single filter conditions.
     *
     * @param list<mixed> $filters
     */
    public function withFilters(array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

        return $self;
    }

    /**
     * The attribute path from the user profile to filter on. Required for single  filter conditions, not used for nested filter groups.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * The value to compare against. Required for single filter conditions,  not used for nested filter groups.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
