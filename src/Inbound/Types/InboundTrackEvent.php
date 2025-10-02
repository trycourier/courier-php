<?php

namespace Courier\Inbound\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class InboundTrackEvent extends JsonSerializableType
{
    /**
     * @var string $event A descriptive name of the event. This name will appear as a trigger in the Courier Automation Trigger node.
     */
    #[JsonProperty('event')]
    public string $event;

    /**
     * @var string $messageId A required unique identifier that will be used to de-duplicate requests. If not unique, will respond with 409 Conflict status
     */
    #[JsonProperty('messageId')]
    public string $messageId;

    /**
     * @var array<string, mixed> $properties
     */
    #[JsonProperty('properties'), ArrayType(['string' => 'mixed'])]
    public array $properties;

    /**
     * @var 'track' $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var ?string $userId The user id assocatiated with the track
     */
    #[JsonProperty('userId')]
    public ?string $userId;

    /**
     * @param array{
     *   event: string,
     *   messageId: string,
     *   properties: array<string, mixed>,
     *   type: 'track',
     *   userId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->event = $values['event'];
        $this->messageId = $values['messageId'];
        $this->properties = $values['properties'];
        $this->type = $values['type'];
        $this->userId = $values['userId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
