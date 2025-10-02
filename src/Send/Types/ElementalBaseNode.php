<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ElementalBaseNode extends JsonSerializableType
{
    /**
     * @var ?array<string> $channels
     */
    #[JsonProperty('channels'), ArrayType(['string'])]
    public ?array $channels;

    /**
     * @var ?string $ref
     */
    #[JsonProperty('ref')]
    public ?string $ref;

    /**
     * @var ?string $if
     */
    #[JsonProperty('if')]
    public ?string $if;

    /**
     * @var ?string $loop
     */
    #[JsonProperty('loop')]
    public ?string $loop;

    /**
     * @param array{
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
