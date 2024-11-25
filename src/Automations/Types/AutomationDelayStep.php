<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationDelayStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var string $action
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
     *   action: string,
     *   duration?: ?string,
     *   until?: ?string,
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->duration = $values['duration'] ?? null;
        $this->until = $values['until'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
    }
}
