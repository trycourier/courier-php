<?php

namespace Courier\Templates\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class RoutingStrategy extends JsonSerializableType
{
    /**
     * @var value-of<RoutingStrategyMethod> $method The method for selecting channels to send the message with. Value can be either 'single' or 'all'. If not provided will default to 'single'
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var array<string> $channels An array of valid channel identifiers (like email, push, sms, etc.) and additional routing nodes.
     */
    #[JsonProperty('channels'), ArrayType(['string'])]
    public array $channels;

    /**
     * @param array{
     *   method: value-of<RoutingStrategyMethod>,
     *   channels: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->channels = $values['channels'];
    }
}
