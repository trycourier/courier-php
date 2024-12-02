<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationCancelStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var string $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var ?string $cancelationToken
     */
    #[JsonProperty('cancelation_token')]
    public ?string $cancelationToken;

    /**
     * @param array{
     *   action: string,
     *   cancelationToken?: ?string,
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->cancelationToken = $values['cancelationToken'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
    }
}
