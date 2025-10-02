<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Core\Types\Union;

class Automation extends JsonSerializableType
{
    /**
     * @var ?string $cancelationToken
     */
    #[JsonProperty('cancelation_token')]
    public ?string $cancelationToken;

    /**
     * @var array<(
     *    AutomationAddToDigestStep
     *   |AutomationAddToBatchStep
     *   |AutomationThrottleStep
     *   |AutomationCancelStep
     *   |AutomationDelayStep
     *   |AutomationFetchDataStep
     *   |AutomationInvokeStep
     *   |AutomationSendStep
     *   |AutomationV2SendStep
     *   |AutomationSendListStep
     *   |AutomationUpdateProfileStep
     * )> $steps
     */
    #[JsonProperty('steps'), ArrayType([new Union(AutomationAddToDigestStep::class, AutomationAddToBatchStep::class, AutomationThrottleStep::class, AutomationCancelStep::class, AutomationDelayStep::class, AutomationFetchDataStep::class, AutomationInvokeStep::class, AutomationSendStep::class, AutomationV2SendStep::class, AutomationSendListStep::class, AutomationUpdateProfileStep::class)])]
    public array $steps;

    /**
     * @param array{
     *   steps: array<(
     *    AutomationAddToDigestStep
     *   |AutomationAddToBatchStep
     *   |AutomationThrottleStep
     *   |AutomationCancelStep
     *   |AutomationDelayStep
     *   |AutomationFetchDataStep
     *   |AutomationInvokeStep
     *   |AutomationSendStep
     *   |AutomationV2SendStep
     *   |AutomationSendListStep
     *   |AutomationUpdateProfileStep
     * )>,
     *   cancelationToken?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cancelationToken = $values['cancelationToken'] ?? null;
        $this->steps = $values['steps'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
