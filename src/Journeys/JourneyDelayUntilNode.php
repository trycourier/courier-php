<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyDelayUntilNode\Mode;
use Courier\Journeys\JourneyDelayUntilNode\Type;

/**
 * Pause the journey run `until` a specific time.
 *
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyDelayUntilNodeShape = array{
 *   mode: Mode|value-of<Mode>,
 *   type: Type|value-of<Type>,
 *   until: string,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 * }
 */
final class JourneyDelayUntilNode implements BaseModel
{
    /** @use SdkModel<JourneyDelayUntilNodeShape> */
    use SdkModel;

    /** @var value-of<Mode> $mode */
    #[Required(enum: Mode::class)]
    public string $mode;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required]
    public string $until;

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
     * `new JourneyDelayUntilNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyDelayUntilNode::with(mode: ..., type: ..., until: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyDelayUntilNode)->withMode(...)->withType(...)->withUntil(...)
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
     * @param Mode|value-of<Mode> $mode
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     */
    public static function with(
        Mode|string $mode,
        Type|string $type,
        string $until,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
    ): self {
        $self = new self;

        $self['mode'] = $mode;
        $self['type'] = $type;
        $self['until'] = $until;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;

        return $self;
    }

    /**
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

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

    public function withUntil(string $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

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
