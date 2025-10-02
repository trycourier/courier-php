<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Timeouts extends JsonSerializableType
{
    /**
     * @var ?int $provider
     */
    #[JsonProperty('provider')]
    public ?int $provider;

    /**
     * @var ?int $channel
     */
    #[JsonProperty('channel')]
    public ?int $channel;

    /**
     * @param array{
     *   provider?: ?int,
     *   channel?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->provider = $values['provider'] ?? null;
        $this->channel = $values['channel'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
