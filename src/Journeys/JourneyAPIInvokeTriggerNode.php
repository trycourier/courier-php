<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyAPIInvokeTriggerNode\TriggerType;
use Courier\Journeys\JourneyAPIInvokeTriggerNode\Type;

/**
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyAPIInvokeTriggerNodeShape = array{
 *   triggerType: TriggerType|value-of<TriggerType>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 *   schema?: array<string,mixed>|null,
 * }
 */
final class JourneyAPIInvokeTriggerNode implements BaseModel
{
    /** @use SdkModel<JourneyAPIInvokeTriggerNodeShape> */
    use SdkModel;

    /** @var value-of<TriggerType> $triggerType */
    #[Required('trigger_type', enum: TriggerType::class)]
    public string $triggerType;

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
     * A JSONSchema object (Draft-07-compatible). Validated at runtime by Ajv.
     *
     * @var array<string,mixed>|null $schema
     */
    #[Optional(map: 'mixed')]
    public ?array $schema;

    /**
     * `new JourneyAPIInvokeTriggerNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyAPIInvokeTriggerNode::with(triggerType: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyAPIInvokeTriggerNode)->withTriggerType(...)->withType(...)
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
     * @param TriggerType|value-of<TriggerType> $triggerType
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     * @param array<string,mixed>|null $schema
     */
    public static function with(
        TriggerType|string $triggerType,
        Type|string $type,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
        ?array $schema = null,
    ): self {
        $self = new self;

        $self['triggerType'] = $triggerType;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;
        null !== $schema && $self['schema'] = $schema;

        return $self;
    }

    /**
     * @param TriggerType|value-of<TriggerType> $triggerType
     */
    public function withTriggerType(TriggerType|string $triggerType): self
    {
        $self = clone $this;
        $self['triggerType'] = $triggerType;

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

    /**
     * A JSONSchema object (Draft-07-compatible). Validated at runtime by Ajv.
     *
     * @param array<string,mixed> $schema
     */
    public function withSchema(array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

        return $self;
    }
}
