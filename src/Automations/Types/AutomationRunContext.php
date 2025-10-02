<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AutomationRunContext extends JsonSerializableType
{
    /**
     * @var ?string $brand
     */
    #[JsonProperty('brand')]
    public ?string $brand;

    /**
     * @var mixed $data
     */
    #[JsonProperty('data')]
    public mixed $data;

    /**
     * @var mixed $profile
     */
    #[JsonProperty('profile')]
    public mixed $profile;

    /**
     * @var ?string $template
     */
    #[JsonProperty('template')]
    public ?string $template;

    /**
     * @var ?string $recipient
     */
    #[JsonProperty('recipient')]
    public ?string $recipient;

    /**
     * @param array{
     *   brand?: ?string,
     *   data?: mixed,
     *   profile?: mixed,
     *   template?: ?string,
     *   recipient?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->brand = $values['brand'] ?? null;
        $this->data = $values['data'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->template = $values['template'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
