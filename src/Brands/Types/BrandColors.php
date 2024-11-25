<?php

namespace Courier\Brands\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BrandColors extends JsonSerializableType
{
    /**
     * @var ?string $primary
     */
    #[JsonProperty('primary')]
    public ?string $primary;

    /**
     * @var ?string $secondary
     */
    #[JsonProperty('secondary')]
    public ?string $secondary;

    /**
     * @var ?string $tertiary
     */
    #[JsonProperty('tertiary')]
    public ?string $tertiary;

    /**
     * @param array{
     *   primary?: ?string,
     *   secondary?: ?string,
     *   tertiary?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->primary = $values['primary'] ?? null;
        $this->secondary = $values['secondary'] ?? null;
        $this->tertiary = $values['tertiary'] ?? null;
    }
}
