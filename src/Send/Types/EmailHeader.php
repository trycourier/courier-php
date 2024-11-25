<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class EmailHeader extends JsonSerializableType
{
    /**
     * @var ?bool $inheritDefault
     */
    #[JsonProperty('inheritDefault')]
    public ?bool $inheritDefault;

    /**
     * @var ?string $barColor
     */
    #[JsonProperty('barColor')]
    public ?string $barColor;

    /**
     * @var Logo $logo
     */
    #[JsonProperty('logo')]
    public Logo $logo;

    /**
     * @param array{
     *   inheritDefault?: ?bool,
     *   barColor?: ?string,
     *   logo: Logo,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->inheritDefault = $values['inheritDefault'] ?? null;
        $this->barColor = $values['barColor'] ?? null;
        $this->logo = $values['logo'];
    }
}
