<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneySegmentTriggerNode\RequestType;
use Courier\Journeys\JourneySegmentTriggerNode\TriggerType;
use Courier\Journeys\JourneySegmentTriggerNode\Type;

/**
 * Trigger fired by a segment event (`identify`, `group`, or `track`).
 *
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneySegmentTriggerNodeShape = array{
 *   requestType: RequestType|value-of<RequestType>,
 *   triggerType: TriggerType|value-of<TriggerType>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 *   eventID?: string|null,
 * }
 */
final class JourneySegmentTriggerNode implements BaseModel
{
    /** @use SdkModel<JourneySegmentTriggerNodeShape> */
    use SdkModel;

    /** @var value-of<RequestType> $requestType */
    #[Required('request_type', enum: RequestType::class)]
    public string $requestType;

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

    #[Optional('event_id')]
    public ?string $eventID;

    /**
     * `new JourneySegmentTriggerNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneySegmentTriggerNode::with(requestType: ..., triggerType: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneySegmentTriggerNode)
     *   ->withRequestType(...)
     *   ->withTriggerType(...)
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
     * @param RequestType|value-of<RequestType> $requestType
     * @param TriggerType|value-of<TriggerType> $triggerType
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     */
    public static function with(
        RequestType|string $requestType,
        TriggerType|string $triggerType,
        Type|string $type,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
        ?string $eventID = null,
    ): self {
        $self = new self;

        $self['requestType'] = $requestType;
        $self['triggerType'] = $triggerType;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;
        null !== $eventID && $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * @param RequestType|value-of<RequestType> $requestType
     */
    public function withRequestType(RequestType|string $requestType): self
    {
        $self = clone $this;
        $self['requestType'] = $requestType;

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

    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }
}
