<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Icons extends JsonSerializableType
{
    /**
     * @var ?string $bell
     */
    #[JsonProperty('bell')]
    public ?string $bell;

    /**
     * @var ?string $message
     */
    #[JsonProperty('message')]
    public ?string $message;

    /**
     * @param array{
     *   bell?: ?string,
     *   message?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->bell = $values['bell'] ?? null;
        $this->message = $values['message'] ?? null;
    }
}
