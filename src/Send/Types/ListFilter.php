<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class ListFilter extends JsonSerializableType
{
    /**
     * @var 'MEMBER_OF' $operator Send to users only if they are member of the account
     */
    #[JsonProperty('operator')]
    public string $operator;

    /**
     * @var 'account_id' $path
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
     *   operator: 'MEMBER_OF',
     *   path: 'account_id',
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
