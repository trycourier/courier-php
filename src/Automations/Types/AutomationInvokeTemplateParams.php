<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationInvokeParams;
use Courier\Core\Json\JsonProperty;

class AutomationInvokeTemplateParams extends JsonSerializableType
{
    use AutomationInvokeParams;

    /**
     * @var string $templateId
     */
    #[JsonProperty('templateId')]
    public string $templateId;

    /**
     * @param array{
     *   templateId: string,
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
        $this->templateId = $values['templateId'];
        $this->brand = $values['brand'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
        $this->template = $values['template'] ?? null;
    }
}
