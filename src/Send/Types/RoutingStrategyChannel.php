<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class RoutingStrategyChannel extends JsonSerializableType
{
    /**
     * @var string $channel
     */
    #[JsonProperty('channel')]
    public string $channel;

    /**
     * @var ?array<string, mixed> $config
     */
    #[JsonProperty('config'), ArrayType(['string' => 'mixed'])]
    public ?array $config;

    /**
     * @var ?value-of<RoutingMethod> $method
     */
    #[JsonProperty('method')]
    public ?string $method;

    /**
     * @var ?array<string, MessageProvidersType> $providers
     */
    #[JsonProperty('providers'), ArrayType(['string' => MessageProvidersType::class])]
    public ?array $providers;

    /**
     * @var ?string $if
     */
    #[JsonProperty('if')]
    public ?string $if;

    /**
     * @param array{
     *   channel: string,
     *   config?: ?array<string, mixed>,
     *   method?: ?value-of<RoutingMethod>,
     *   providers?: ?array<string, MessageProvidersType>,
     *   if?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channel = $values['channel'];
        $this->config = $values['config'] ?? null;
        $this->method = $values['method'] ?? null;
        $this->providers = $values['providers'] ?? null;
        $this->if = $values['if'] ?? null;
    }
}
