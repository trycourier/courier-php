<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationInvokeStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var 'invoke' $action
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
     *   action: 'invoke',
     *   template: string,
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->action = $values['action'];
        $this->template = $values['template'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
