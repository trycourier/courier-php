<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationInvokeParams;
use Courier\Core\Json\JsonProperty;

class AutomationAdHocInvokeParams extends JsonSerializableType
{
    use AutomationInvokeParams;

    /**
     * @var Automation $automation
     */
    #[JsonProperty('automation')]
    public Automation $automation;

    /**
     * @param array{
     *   automation: Automation,
     *   brand?: ?string,
     *   data?: ?array<string, mixed>,
     *   profile?: mixed,
     *   recipient?: ?string,
     *   template?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->automation = $values['automation'];
        $this->brand = $values['brand'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
        $this->template = $values['template'] ?? null;
    }
}
