<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\AudienceUpdateParams\Operator;
use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Creates or updates audience.
 *
 * @see Courier\Services\AudiencesService::update()
 *
 * @phpstan-import-type FilterShape from \Courier\Audiences\Filter
 *
 * @phpstan-type AudienceUpdateParamsShape = array{
 *   description?: string|null,
 *   filter?: null|Filter|FilterShape,
 *   name?: string|null,
 *   operator?: null|Operator|value-of<Operator>,
 * }
 */
final class AudienceUpdateParams implements BaseModel
{
    /** @use SdkModel<AudienceUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A description of the audience.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Filter that contains an array of FilterConfig items.
     */
    #[Optional(nullable: true)]
    public ?Filter $filter;

    /**
     * The name of the audience.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * The logical operator (AND/OR) for the top-level filter.
     *
     * @var value-of<Operator>|null $operator
     */
    #[Optional(enum: Operator::class, nullable: true)]
    public ?string $operator;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Filter|FilterShape|null $filter
     * @param Operator|value-of<Operator>|null $operator
     */
    public static function with(
        ?string $description = null,
        Filter|array|null $filter = null,
        ?string $name = null,
        Operator|string|null $operator = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $filter && $self['filter'] = $filter;
        null !== $name && $self['name'] = $name;
        null !== $operator && $self['operator'] = $operator;

        return $self;
    }

    /**
     * A description of the audience.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Filter that contains an array of FilterConfig items.
     *
     * @param Filter|FilterShape|null $filter
     */
    public function withFilter(Filter|array|null $filter): self
    {
        $self = clone $this;
        $self['filter'] = $filter;

        return $self;
    }

    /**
     * The name of the audience.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The logical operator (AND/OR) for the top-level filter.
     *
     * @param Operator|value-of<Operator>|null $operator
     */
    public function withOperator(Operator|string|null $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }
}
