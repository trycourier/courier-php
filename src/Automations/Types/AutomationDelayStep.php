<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationDelayStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var 'delay' $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var ?string $duration The [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations) string for how long to delay for
     */
    #[JsonProperty('duration')]
    public ?string $duration;

    /**
     * @var ?string $until The ISO 8601 timestamp for when the delay should end
     */
    #[JsonProperty('until')]
    public ?string $until;

    /**
     * @param array{
     *   action: 'delay',
     *   if?: ?string,
     *   ref?: ?string,
     *   duration?: ?string,
     *   until?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->action = $values['action'];
        $this->duration = $values['duration'] ?? null;
        $this->until = $values['until'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
