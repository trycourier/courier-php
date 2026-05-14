<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A nested condition group. Exactly one of `AND` or `OR` must be present at runtime; each is a list of `JourneyConditionGroup` items.
 *
 * @phpstan-import-type JourneyConditionGroupShape from \Courier\Journeys\JourneyConditionGroup
 *
 * @phpstan-type JourneyConditionNestedGroupShape = array{
 *   and?: list<JourneyConditionGroup|JourneyConditionGroupShape>|null,
 *   or?: list<JourneyConditionGroup|JourneyConditionGroupShape>|null,
 * }
 */
final class JourneyConditionNestedGroup implements BaseModel
{
    /** @use SdkModel<JourneyConditionNestedGroupShape> */
    use SdkModel;

    /** @var list<JourneyConditionGroup>|null $and */
    #[Optional('AND', list: JourneyConditionGroup::class)]
    public ?array $and;

    /** @var list<JourneyConditionGroup>|null $or */
    #[Optional('OR', list: JourneyConditionGroup::class)]
    public ?array $or;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<JourneyConditionGroup|JourneyConditionGroupShape>|null $and
     * @param list<JourneyConditionGroup|JourneyConditionGroupShape>|null $or
     */
    public static function with(?array $and = null, ?array $or = null): self
    {
        $self = new self;

        null !== $and && $self['and'] = $and;
        null !== $or && $self['or'] = $or;

        return $self;
    }

    /**
     * @param list<JourneyConditionGroup|JourneyConditionGroupShape> $and
     */
    public function withAnd(array $and): self
    {
        $self = clone $this;
        $self['and'] = $and;

        return $self;
    }

    /**
     * @param list<JourneyConditionGroup|JourneyConditionGroupShape> $or
     */
    public function withOr(array $or): self
    {
        $self = clone $this;
        $self['or'] = $or;

        return $self;
    }
}
