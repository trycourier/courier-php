<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AudienceFilter extends JsonSerializableType
{
    /**
     * @var string $operator Send to users only if they are member of the account
     */
    #[JsonProperty('operator')]
    public string $operator;

    /**
     * @var string $path
     */
    #[JsonProperty('path')]
    public string $path;

    /**
     * @var string $value
     */
    #[JsonProperty('value')]
    public string $value;

    /**
     * @param array{
     *   operator: string,
     *   path: string,
     *   value: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->operator = $values['operator'];
        $this->path = $values['path'];
        $this->value = $values['value'];
    }
}
