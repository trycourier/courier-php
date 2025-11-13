<?php

declare(strict_types=1);

namespace Courier\Inbound;

use Courier\Core\Attributes\Api;
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
 *   messageId: string,
 *   properties: array<string,mixed>,
 *   type: Type|value-of<Type>,
 *   userId?: string|null,
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
    #[Api]
    public string $event;

    /**
     * A required unique identifier that will be used to de-duplicate requests. If not unique, will respond with 409 Conflict status.
     */
    #[Api]
    public string $messageId;

    /** @var array<string,mixed> $properties */
    #[Api(map: 'mixed')]
    public array $properties;

    /** @var value-of<Type> $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * The user id associatiated with the track.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $userId;

    /**
     * `new InboundTrackEventParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundTrackEventParams::with(
     *   event: ..., messageId: ..., properties: ..., type: ...
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
        string $messageId,
        array $properties,
        Type|string $type,
        ?string $userId = null,
    ): self {
        $obj = new self;

        $obj->event = $event;
        $obj->messageId = $messageId;
        $obj->properties = $properties;
        $obj['type'] = $type;

        null !== $userId && $obj->userId = $userId;

        return $obj;
    }

    /**
     * A descriptive name of the event. This name will appear as a trigger in the Courier Automation Trigger node.
     */
    public function withEvent(string $event): self
    {
        $obj = clone $this;
        $obj->event = $event;

        return $obj;
    }

    /**
     * A required unique identifier that will be used to de-duplicate requests. If not unique, will respond with 409 Conflict status.
     */
    public function withMessageID(string $messageID): self
    {
        $obj = clone $this;
        $obj->messageId = $messageID;

        return $obj;
    }

    /**
     * @param array<string,mixed> $properties
     */
    public function withProperties(array $properties): self
    {
        $obj = clone $this;
        $obj->properties = $properties;

        return $obj;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * The user id associatiated with the track.
     */
    public function withUserID(?string $userID): self
    {
        $obj = clone $this;
        $obj->userId = $userID;

        return $obj;
    }
}
