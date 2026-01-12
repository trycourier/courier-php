<?php

declare(strict_types=1);

namespace Courier\Inbound;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Inbound\InboundTrackEventParams\Type;

/**
 * Courier Track Event.
 *
 * @see Courier\Services\InboundService::trackEvent()
 *
 * @phpstan-type InboundTrackEventParamsShape = array{
 *   event: string,
 *   messageID: string,
 *   properties: array<string,mixed>,
 *   type: Type|value-of<Type>,
 *   userID?: string|null,
 * }
 */
final class InboundTrackEventParams implements BaseModel
{
    /** @use SdkModel<InboundTrackEventParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A descriptive name of the event. This name will appear as a trigger in the Courier Automation Trigger node.
     */
    #[Required]
    public string $event;

    /**
     * A required unique identifier that will be used to de-duplicate requests. If not unique, will respond with 409 Conflict status.
     */
    #[Required('messageId')]
    public string $messageID;

    /** @var array<string,mixed> $properties */
    #[Required(map: 'mixed')]
    public array $properties;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The user id associated with the track.
     */
    #[Optional('userId', nullable: true)]
    public ?string $userID;

    /**
     * `new InboundTrackEventParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundTrackEventParams::with(
     *   event: ..., messageID: ..., properties: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundTrackEventParams)
     *   ->withEvent(...)
     *   ->withMessageID(...)
     *   ->withProperties(...)
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
     * @param array<string,mixed> $properties
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $event,
        string $messageID,
        array $properties,
        Type|string $type,
        ?string $userID = null,
    ): self {
        $self = new self;

        $self['event'] = $event;
        $self['messageID'] = $messageID;
        $self['properties'] = $properties;
        $self['type'] = $type;

        null !== $userID && $self['userID'] = $userID;

        return $self;
    }

    /**
     * A descriptive name of the event. This name will appear as a trigger in the Courier Automation Trigger node.
     */
    public function withEvent(string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * A required unique identifier that will be used to de-duplicate requests. If not unique, will respond with 409 Conflict status.
     */
    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }

    /**
     * @param array<string,mixed> $properties
     */
    public function withProperties(array $properties): self
    {
        $self = clone $this;
        $self['properties'] = $properties;

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

    /**
     * The user id associated with the track.
     */
    public function withUserID(?string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
