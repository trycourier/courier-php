<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyWebhookTriggerNode\TriggerType;
use Courier\Journeys\JourneyWebhookTriggerNode\Type;

/**
 * Trigger fired when an external system POSTs to the webhook URL minted for `event_source`. Narrow it to one event with `event_id`, or omit `event_id` to accept every event delivered to the URL.
 *
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyWebhookTriggerNodeShape = array{
 *   eventSource: string,
 *   triggerType: TriggerType|value-of<TriggerType>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 *   eventID?: string|null,
 * }
 */
final class JourneyWebhookTriggerNode implements BaseModel
{
    /** @use SdkModel<JourneyWebhookTriggerNodeShape> */
    use SdkModel;

    /**
     * The provider key the webhook URL is minted for. Required, and must not contain a forward slash.
     */
    #[Required('event_source')]
    public string $eventSource;

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
     * An optional event filter, matched against the payload's `event` field. A sender that supplies no `event` matches the literal `custom`. Must not contain a forward slash. Omit to accept every event delivered to the URL.
     */
    #[Optional('event_id')]
    public ?string $eventID;

    /**
     * `new JourneyWebhookTriggerNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyWebhookTriggerNode::with(eventSource: ..., triggerType: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyWebhookTriggerNode)
     *   ->withEventSource(...)
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
     * @param TriggerType|value-of<TriggerType> $triggerType
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     */
    public static function with(
        string $eventSource,
        TriggerType|string $triggerType,
        Type|string $type,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
        ?string $eventID = null,
    ): self {
        $self = new self;

        $self['eventSource'] = $eventSource;
        $self['triggerType'] = $triggerType;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;
        null !== $eventID && $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * The provider key the webhook URL is minted for. Required, and must not contain a forward slash.
     */
    public function withEventSource(string $eventSource): self
    {
        $self = clone $this;
        $self['eventSource'] = $eventSource;

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
     * An optional event filter, matched against the payload's `event` field. A sender that supplies no `event` matches the literal `custom`. Must not contain a forward slash. Omit to accept every event delivered to the URL.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }
}
