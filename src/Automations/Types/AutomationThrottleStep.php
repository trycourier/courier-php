<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationThrottleStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var 'throttle' $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var int $maxAllowed Maximum number of allowed notifications in that timeframe
     */
    #[JsonProperty('max_allowed')]
    public int $maxAllowed;

    /**
     * @var string $period Defines the throttle period which corresponds to the max_allowed. Specified as an ISO 8601 duration, https://en.wikipedia.org/wiki/ISO_8601#Durations
     */
    #[JsonProperty('period')]
    public string $period;

    /**
     * @var value-of<AutomationThrottleScope> $scope
     */
    #[JsonProperty('scope')]
    public string $scope;

    /**
     * @var ?string $throttleKey If using scope=dynamic, provide the reference (e.g., refs.data.throttle_key) to the how the throttle should be identified
     */
    #[JsonProperty('throttle_key')]
    public ?string $throttleKey;

    /**
     * @var false $shouldAlert Value must be true
     */
    #[JsonProperty('should_alert')]
    public bool $shouldAlert;

    /**
     * @var AutomationThrottleOnThrottle $onThrottle
     */
    #[JsonProperty('on_throttle')]
    public AutomationThrottleOnThrottle $onThrottle;

    /**
     * @param array{
     *   action: 'throttle',
     *   maxAllowed: int,
     *   period: string,
     *   scope: value-of<AutomationThrottleScope>,
     *   shouldAlert: false,
     *   onThrottle: AutomationThrottleOnThrottle,
     *   if?: ?string,
     *   ref?: ?string,
     *   throttleKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->action = $values['action'];
        $this->maxAllowed = $values['maxAllowed'];
        $this->period = $values['period'];
        $this->scope = $values['scope'];
        $this->throttleKey = $values['throttleKey'] ?? null;
        $this->shouldAlert = $values['shouldAlert'];
        $this->onThrottle = $values['onThrottle'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
