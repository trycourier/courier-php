<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\ListOf;

/**
 * A leaf condition group. Exactly one of `AND` or `OR` must be present at runtime; each is a list of `JourneyConditionAtom` tuples.
 *
 * @phpstan-type JourneyConditionGroupShape = array{
 *   and?: list<list<string>>|null, or?: list<list<string>>|null
 * }
 */
final class JourneyConditionGroup implements BaseModel
{
    /** @use SdkModel<JourneyConditionGroupShape> */
    use SdkModel;

    /** @var list<list<string>>|null $and */
    #[Optional('AND', list: new ListOf('string'))]
    public ?array $and;

    /** @var list<list<string>>|null $or */
    #[Optional('OR', list: new ListOf('string'))]
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
     * @param list<list<string>>|null $and
     * @param list<list<string>>|null $or
     */
    public static function with(?array $and = null, ?array $or = null): self
    {
        $self = new self;

        null !== $and && $self['and'] = $and;
        null !== $or && $self['or'] = $or;

        return $self;
    }

    /**
     * @param list<list<string>> $and
     */
    public function withAnd(array $and): self
    {
        $self = clone $this;
        $self['and'] = $and;

        return $self;
    }

    /**
     * @param list<list<string>> $or
     */
    public function withOr(array $or): self
    {
        $self = clone $this;
        $self['or'] = $or;

        return $self;
    }
}
