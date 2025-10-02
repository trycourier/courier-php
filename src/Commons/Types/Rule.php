<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Rule extends JsonSerializableType
{
    /**
     * @var ?string $start
     */
    #[JsonProperty('start')]
    public ?string $start;

    /**
     * @var string $until
     */
    #[JsonProperty('until')]
    public string $until;

    /**
     * @param array{
     *   until: string,
     *   start?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->start = $values['start'] ?? null;
        $this->until = $values['until'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
