<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class AutomationSendStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var 'send' $action
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
     * @var ?array<string, mixed> $override
     */
    #[JsonProperty('override'), ArrayType(['string' => 'mixed'])]
    public ?array $override;

    /**
     * @var mixed $profile
     */
    #[JsonProperty('profile')]
    public mixed $profile;

    /**
     * @var ?string $recipient
     */
    #[JsonProperty('recipient')]
    public ?string $recipient;

    /**
     * @var ?string $template
     */
    #[JsonProperty('template')]
    public ?string $template;

    /**
     * @param array{
     *   action: 'send',
     *   if?: ?string,
     *   ref?: ?string,
     *   brand?: ?string,
     *   data?: ?array<string, mixed>,
     *   override?: ?array<string, mixed>,
     *   profile?: mixed,
     *   recipient?: ?string,
     *   template?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->action = $values['action'];
        $this->brand = $values['brand'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->override = $values['override'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
        $this->template = $values['template'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
