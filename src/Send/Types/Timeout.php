<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class Timeout extends JsonSerializableType
{
    /**
     * @var ?array<string, int> $provider
     */
    #[JsonProperty('provider'), ArrayType(['string' => 'integer'])]
    public ?array $provider;

    /**
     * @var ?array<string, int> $channel
     */
    #[JsonProperty('channel'), ArrayType(['string' => 'integer'])]
    public ?array $channel;

    /**
     * @var ?int $message
     */
    #[JsonProperty('message')]
    public ?int $message;

    /**
     * @var ?int $escalation
     */
    #[JsonProperty('escalation')]
    public ?int $escalation;

    /**
     * @var ?value-of<Criteria> $criteria
     */
    #[JsonProperty('criteria')]
    public ?string $criteria;

    /**
     * @param array{
     *   provider?: ?array<string, int>,
     *   channel?: ?array<string, int>,
     *   message?: ?int,
     *   escalation?: ?int,
     *   criteria?: ?value-of<Criteria>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->provider = $values['provider'] ?? null;
        $this->channel = $values['channel'] ?? null;
        $this->message = $values['message'] ?? null;
        $this->escalation = $values['escalation'] ?? null;
        $this->criteria = $values['criteria'] ?? null;
    }
}
