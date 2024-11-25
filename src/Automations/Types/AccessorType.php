<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AccessorType extends JsonSerializableType
{
    /**
     * @var string $ref
     */
    #[JsonProperty('$ref')]
    public string $ref;

    /**
     * @param array{
     *   ref: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->ref = $values['ref'];
    }
}
