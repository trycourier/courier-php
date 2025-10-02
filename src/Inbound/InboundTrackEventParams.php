<?php

declare(strict_types=1);

namespace Courier\Inbound;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Inbound\InboundTrackEventParams\Type;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new InboundTrackEventParams); // set properties as needed
 * $client->inbound->trackEvent(...$params->toArray());
 * ```
 * Courier Track Event.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->inbound->trackEvent(...$params->toArray());`
 *
 * @see Courier\Inbound->trackEvent
 *
 * @phpstan-type inbound_track_event_params = array{
 *   event: string,
 *   messageID: string,
 *   properties: array<string, mixed>,
 *   type: Type|value-of<Type>,
 *   userID?: string|null,
 * }
 */
final class InboundTrackEventParams implements BaseModel
{
    /** @use SdkModel<inbound_track_event_params> */
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
    #[Api('messageId')]
    public string $messageID;

    /** @var array<string, mixed> $properties */
    #[Api(map: 'mixed')]
    public array $properties;

    /** @var value-of<Type> $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * The user id associatiated with the track.
     */
    #[Api('userId', nullable: true, optional: true)]
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
     * @param array<string, mixed> $properties
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $event,
        string $messageID,
        array $properties,
        Type|string $type,
        ?string $userID = null,
    ): self {
        $obj = new self;

        $obj->event = $event;
        $obj->messageID = $messageID;
        $obj->properties = $properties;
        $obj->type = $type instanceof Type ? $type->value : $type;

        null !== $userID && $obj->userID = $userID;

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
        $obj->messageID = $messageID;

        return $obj;
    }

    /**
     * @param array<string, mixed> $properties
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
        $obj->type = $type instanceof Type ? $type->value : $type;

        return $obj;
    }

    /**
     * The user id associatiated with the track.
     */
    public function withUserID(?string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }
}
