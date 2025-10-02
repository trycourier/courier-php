<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class AutomationInvokeParams extends JsonSerializableType
{
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
     *   brand?: ?string,
     *   data?: ?array<string, mixed>,
     *   profile?: mixed,
     *   recipient?: ?string,
     *   template?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->brand = $values['brand'] ?? null;
        $this->data = $values['data'] ?? null;
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
