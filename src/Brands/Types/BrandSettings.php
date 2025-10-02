<?php

namespace Courier\Brands\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\Email;

class BrandSettings extends JsonSerializableType
{
    /**
     * @var ?BrandColors $colors
     */
    #[JsonProperty('colors')]
    public ?BrandColors $colors;

    /**
     * @var mixed $inapp
     */
    #[JsonProperty('inapp')]
    public mixed $inapp;

    /**
     * @var ?Email $email
     */
    #[JsonProperty('email')]
    public ?Email $email;

    /**
     * @param array{
     *   colors?: ?BrandColors,
     *   inapp?: mixed,
     *   email?: ?Email,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->colors = $values['colors'] ?? null;
        $this->inapp = $values['inapp'] ?? null;
        $this->email = $values['email'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
