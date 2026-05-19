<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneySendNode\Message;
use Courier\Journeys\JourneySendNode\Type;

/**
 * Send a notification template to the recipient. Optionally override the recipient address, delay the send, or attach `data`.
 *
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type MessageShape from \Courier\Journeys\JourneySendNode\Message
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneySendNodeShape = array{
 *   message: Message|MessageShape,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 * }
 */
final class JourneySendNode implements BaseModel
{
    /** @use SdkModel<JourneySendNodeShape> */
    use SdkModel;

    #[Required]
    public Message $message;

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
     * `new JourneySendNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneySendNode::with(message: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneySendNode)->withMessage(...)->withType(...)
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
     * @param Message|MessageShape $message
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     */
    public static function with(
        Message|array $message,
        Type|string $type,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
    ): self {
        $self = new self;

        $self['message'] = $message;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;

        return $self;
    }

    /**
     * @param Message|MessageShape $message
     */
    public function withMessage(Message|array $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

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
