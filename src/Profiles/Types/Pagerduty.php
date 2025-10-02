<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Pagerduty extends JsonSerializableType
{
    /**
     * @var ?string $routingKey
     */
    #[JsonProperty('routing_key')]
    public ?string $routingKey;

    /**
     * @var ?string $eventAction
     */
    #[JsonProperty('event_action')]
    public ?string $eventAction;

    /**
     * @var ?string $severity
     */
    #[JsonProperty('severity')]
    public ?string $severity;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @param array{
     *   routingKey?: ?string,
     *   eventAction?: ?string,
     *   severity?: ?string,
     *   source?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->routingKey = $values['routingKey'] ?? null;
        $this->eventAction = $values['eventAction'] ?? null;
        $this->severity = $values['severity'] ?? null;
        $this->source = $values['source'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
