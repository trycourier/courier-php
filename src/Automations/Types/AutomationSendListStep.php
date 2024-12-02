<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class AutomationSendListStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var string $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var ?string $brand
     */
    #[JsonProperty('brand')]
    public ?string $brand;

    /**
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    public ?array $data;

    /**
     * @var string $list
     */
    #[JsonProperty('list')]
    public string $list;

    /**
     * @var ?array<string, mixed> $override
     */
    #[JsonProperty('override'), ArrayType(['string' => 'mixed'])]
    public ?array $override;

    /**
     * @var ?string $template
     */
    #[JsonProperty('template')]
    public ?string $template;

    /**
     * @param array{
     *   action: string,
     *   brand?: ?string,
     *   data?: ?array<string, mixed>,
     *   list: string,
     *   override?: ?array<string, mixed>,
     *   template?: ?string,
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->brand = $values['brand'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->list = $values['list'];
        $this->override = $values['override'] ?? null;
        $this->template = $values['template'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
    }
}
