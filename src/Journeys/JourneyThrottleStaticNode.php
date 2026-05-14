<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyThrottleStaticNode\Scope;
use Courier\Journeys\JourneyThrottleStaticNode\Type;

/**
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyThrottleStaticNodeShape = array{
 *   maxAllowed: int,
 *   period: string,
 *   scope: Scope|value-of<Scope>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 * }
 */
final class JourneyThrottleStaticNode implements BaseModel
{
    /** @use SdkModel<JourneyThrottleStaticNodeShape> */
    use SdkModel;

    #[Required('max_allowed')]
    public int $maxAllowed;

    #[Required]
    public string $period;

    /** @var value-of<Scope> $scope */
    #[Required(enum: Scope::class)]
    public string $scope;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional]
    public ?string $id;

    /**
     * Condition spec for a journey node. Accepts a single condition atom, an AND/OR group, or an AND/OR nested group. Omit the `conditions` property entirely to express "no conditions".
     *
     * @var JourneyConditionsFieldVariants|null $conditions
     */
    #[Optional(union: JourneyConditionsField::class)]
    public array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions;

    /**
     * `new JourneyThrottleStaticNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyThrottleStaticNode::with(
     *   maxAllowed: ..., period: ..., scope: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyThrottleStaticNode)
     *   ->withMaxAllowed(...)
     *   ->withPeriod(...)
     *   ->withScope(...)
     *   ->withType(...)
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
     * @param Scope|value-of<Scope> $scope
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     */
    public static function with(
        int $maxAllowed,
        string $period,
        Scope|string $scope,
        Type|string $type,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
    ): self {
        $self = new self;

        $self['maxAllowed'] = $maxAllowed;
        $self['period'] = $period;
        $self['scope'] = $scope;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;

        return $self;
    }

    public function withMaxAllowed(int $maxAllowed): self
    {
        $self = clone $this;
        $self['maxAllowed'] = $maxAllowed;

        return $self;
    }

    public function withPeriod(string $period): self
    {
        $self = clone $this;
        $self['period'] = $period;

        return $self;
    }

    /**
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Condition spec for a journey node. Accepts a single condition atom, an AND/OR group, or an AND/OR nested group. Omit the `conditions` property entirely to express "no conditions".
     *
     * @param JourneyConditionsFieldShape $conditions
     */
    public function withConditions(
        array|JourneyConditionGroup|JourneyConditionNestedGroup $conditions
    ): self {
        $self = clone $this;
        $self['conditions'] = $conditions;

        return $self;
    }
}
