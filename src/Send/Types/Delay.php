<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Delay extends JsonSerializableType
{
    /**
     * @var ?int $duration The duration of the delay in milliseconds.
     */
    #[JsonProperty('duration')]
    public ?int $duration;

    /**
     * @var ?string $until An ISO 8601 timestamp that specifies when it should be delivered or an OpenStreetMap opening_hours-like format that specifies the [Delivery Window](https://www.courier.com/docs/platform/sending/failover/#delivery-window) (e.g., 'Mo-Fr 08:00-18:00pm')
     */
    #[JsonProperty('until')]
    public ?string $until;

    /**
     * @param array{
     *   duration?: ?int,
     *   until?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->duration = $values['duration'] ?? null;
        $this->until = $values['until'] ?? null;
    }
}
