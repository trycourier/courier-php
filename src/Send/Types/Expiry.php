<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class Expiry extends JsonSerializableType
{
    /**
     * @var ?string $expiresAt An epoch timestamp or ISO8601 timestamp with timezone `(YYYY-MM-DDThh:mm:ss.sTZD)` that describes the time in which a message expires.
     */
    #[JsonProperty('expires_at')]
    public ?string $expiresAt;

    /**
     * @var (
     *    string
     *   |int
     * ) $expiresIn A duration in the form of milliseconds or an ISO8601 Duration format (i.e. P1DT4H).
     */
    #[JsonProperty('expires_in'), Union('string', 'integer')]
    public string|int $expiresIn;

    /**
     * @param array{
     *   expiresIn: (
     *    string
     *   |int
     * ),
     *   expiresAt?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->expiresAt = $values['expiresAt'] ?? null;
        $this->expiresIn = $values['expiresIn'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
