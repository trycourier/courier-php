<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;
use Courier\Core\Types\Union;

class MessageRouting extends JsonSerializableType
{
    /**
     * @var value-of<MessageRoutingMethod> $method
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var array<(
     *    string
     *   |MessageRouting
     * )> $channels
     */
    #[JsonProperty('channels'), ArrayType([new Union('string', MessageRouting::class)])]
    public array $channels;

    /**
     * @param array{
     *   method: value-of<MessageRoutingMethod>,
     *   channels: array<(
     *    string
     *   |MessageRouting
     * )>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->channels = $values['channels'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
