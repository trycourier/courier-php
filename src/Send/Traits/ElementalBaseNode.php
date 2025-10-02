<?php

namespace Courier\Send\Traits;

use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * @property ?array<string> $channels
 * @property ?string $ref
 * @property ?string $if
 * @property ?string $loop
 */
trait ElementalBaseNode
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
}
