<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationInvokeStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var string $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var string $template
     */
    #[JsonProperty('template')]
    public string $template;

    /**
     * @param array{
     *   action: string,
     *   template: string,
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->template = $values['template'];
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
    }
}
