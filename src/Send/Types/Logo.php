<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Logo extends JsonSerializableType
{
    /**
     * @var ?string $href
     */
    #[JsonProperty('href')]
    public ?string $href;

    /**
     * @var ?string $image
     */
    #[JsonProperty('image')]
    public ?string $image;

    /**
     * @param array{
     *   href?: ?string,
     *   image?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->href = $values['href'] ?? null;
        $this->image = $values['image'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
