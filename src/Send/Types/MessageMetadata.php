<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class MessageMetadata extends JsonSerializableType
{
    /**
     * @var ?string $event An arbitrary string to tracks the event that generated this request (e.g. 'signup').
     */
    #[JsonProperty('event')]
    public ?string $event;

    /**
     * @var ?array<string> $tags An array of up to 9 tags you wish to associate with this request (and corresponding messages) for later analysis. Individual tags cannot be more than 30 characters in length.
     */
    #[JsonProperty('tags'), ArrayType(['string'])]
    public ?array $tags;

    /**
     * @var ?Utm $utm Identify the campaign that refers traffic to a specific website, and attributes the browser's website session.
     */
    #[JsonProperty('utm')]
    public ?Utm $utm;

    /**
     * @var ?string $traceId A unique ID used to correlate this request to processing on your servers. Note: Courier does not verify the uniqueness of this ID.
     */
    #[JsonProperty('trace_id')]
    public ?string $traceId;

    /**
     * @param array{
     *   event?: ?string,
     *   tags?: ?array<string>,
     *   utm?: ?Utm,
     *   traceId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->event = $values['event'] ?? null;
        $this->tags = $values['tags'] ?? null;
        $this->utm = $values['utm'] ?? null;
        $this->traceId = $values['traceId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
