<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyNode;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyConditionGroup;
use Courier\Journeys\JourneyConditionNestedGroup;
use Courier\Journeys\JourneyConditionsField;
use Courier\Journeys\JourneyNode\JourneyAddToDigestNode\Type;

/**
 * Add the current event to a digest keyed by the given subscription topic. The digest accumulates events and releases them on the schedule configured for the topic.
 *
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyAddToDigestNodeShape = array{
 *   subscriptionTopicID: string,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 * }
 */
final class JourneyAddToDigestNode implements BaseModel
{
    /** @use SdkModel<JourneyAddToDigestNodeShape> */
    use SdkModel;

    /**
     * The subscription topic that owns the digest the event is added to.
     */
    #[Required('subscription_topic_id')]
    public string $subscriptionTopicID;

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
     * `new JourneyAddToDigestNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyAddToDigestNode::with(subscriptionTopicID: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyAddToDigestNode)->withSubscriptionTopicID(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     */
    public static function with(
        string $subscriptionTopicID,
        Type|string $type,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
    ): self {
        $self = new self;

        $self['subscriptionTopicID'] = $subscriptionTopicID;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;

        return $self;
    }

    /**
     * The subscription topic that owns the digest the event is added to.
     */
    public function withSubscriptionTopicID(string $subscriptionTopicID): self
    {
        $self = clone $this;
        $self['subscriptionTopicID'] = $subscriptionTopicID;

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
