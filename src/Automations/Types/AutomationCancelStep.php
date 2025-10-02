<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationCancelStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var 'cancel' $action
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
     *   action: 'cancel',
     *   if?: ?string,
     *   ref?: ?string,
     *   cancelationToken?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->action = $values['action'];
        $this->cancelationToken = $values['cancelationToken'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
