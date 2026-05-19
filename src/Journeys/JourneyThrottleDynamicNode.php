<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyThrottleDynamicNode\Scope;
use Courier\Journeys\JourneyThrottleDynamicNode\Type;

/**
 * Throttle the journey by a dynamic `throttle_key`, allowing at most `max_allowed` invocations per `period`.
 *
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyThrottleDynamicNodeShape = array{
 *   maxAllowed: int,
 *   period: string,
 *   scope: Scope|value-of<Scope>,
 *   throttleKey: string,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 * }
 */
final class JourneyThrottleDynamicNode implements BaseModel
{
    /** @use SdkModel<JourneyThrottleDynamicNodeShape> */
    use SdkModel;

    #[Required('max_allowed')]
    public int $maxAllowed;

    #[Required]
    public string $period;

    /** @var value-of<Scope> $scope */
    #[Required(enum: Scope::class)]
    public string $scope;

    #[Required('throttle_key')]
    public string $throttleKey;

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
     * `new JourneyThrottleDynamicNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyThrottleDynamicNode::with(
     *   maxAllowed: ..., period: ..., scope: ..., throttleKey: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyThrottleDynamicNode)
     *   ->withMaxAllowed(...)
     *   ->withPeriod(...)
     *   ->withScope(...)
     *   ->withThrottleKey(...)
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
        string $throttleKey,
        Type|string $type,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
    ): self {
        $self = new self;

        $self['maxAllowed'] = $maxAllowed;
        $self['period'] = $period;
        $self['scope'] = $scope;
        $self['throttleKey'] = $throttleKey;
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

    public function withThrottleKey(string $throttleKey): self
    {
        $self = clone $this;
        $self['throttleKey'] = $throttleKey;

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
