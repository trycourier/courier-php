<?php

declare(strict_types=1);

namespace Courier;

use Courier\AudienceFilterConfig\Operator;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Filter configuration for audience membership containing an array of filter rules.
 *
 * @phpstan-type AudienceFilterConfigShape = array{
 *   filters: list<mixed>, operator?: null|Operator|value-of<Operator>
 * }
 */
final class AudienceFilterConfig implements BaseModel
{
    /** @use SdkModel<AudienceFilterConfigShape> */
    use SdkModel;

    /**
     * Array of filter rules (single conditions or nested groups).
     *
     * @var list<mixed> $filters
     */
    #[Required(list: FilterConfig::class)]
    public array $filters;

    /**
     * The logical operator (AND/OR) combining the rules in `filters`. Required when `filters` contains more than one rule. If omitted, the top-level `operator` field on the request is used instead.
     *
     * @var value-of<Operator>|null $operator
     */
    #[Optional(enum: Operator::class)]
    public ?string $operator;

    /**
     * `new AudienceFilterConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AudienceFilterConfig::with(filters: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AudienceFilterConfig)->withFilters(...)
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
     * @param Operator|value-of<Operator>|null $operator
     */
    public static function with(
        array $filters,
        Operator|string|null $operator = null
    ): self {
        $self = new self;

        $self['filters'] = $filters;

        null !== $operator && $self['operator'] = $operator;

        return $self;
    }

    /**
     * Array of filter rules (single conditions or nested groups).
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
     * The logical operator (AND/OR) combining the rules in `filters`. Required when `filters` contains more than one rule. If omitted, the top-level `operator` field on the request is used instead.
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
