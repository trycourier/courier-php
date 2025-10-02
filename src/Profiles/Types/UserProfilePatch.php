<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class UserProfilePatch extends JsonSerializableType
{
    /**
     * @var string $op The operation to perform.
     */
    #[JsonProperty('op')]
    public string $op;

    /**
     * @var string $path The JSON path specifying the part of the profile to operate on.
     */
    #[JsonProperty('path')]
    public string $path;

    /**
     * @var string $value The value for the operation.
     */
    #[JsonProperty('value')]
    public string $value;

    /**
     * @param array{
     *   op: string,
     *   path: string,
     *   value: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->op = $values['op'];
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
