<?php

namespace Courier\AuthTokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class IssueTokenResponse extends JsonSerializableType
{
    /**
     * @var ?string $token
     */
    #[JsonProperty('token')]
    public ?string $token;

    /**
     * @param array{
     *   token?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->token = $values['token'] ?? null;
    }
}
