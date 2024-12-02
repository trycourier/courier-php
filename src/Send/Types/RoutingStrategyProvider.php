<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class RoutingStrategyProvider extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?array<string, mixed> $config
     */
    #[JsonProperty('config'), ArrayType(['string' => 'mixed'])]
    public ?array $config;

    /**
     * @var ?string $if
     */
    #[JsonProperty('if')]
    public ?string $if;

    /**
     * @var Metadata $metadata
     */
    #[JsonProperty('metadata')]
    public Metadata $metadata;

    /**
     * @param array{
     *   name: string,
     *   config?: ?array<string, mixed>,
     *   if?: ?string,
     *   metadata: Metadata,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->config = $values['config'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->metadata = $values['metadata'];
    }
}
