<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Traits\BaseError;
use Courier\Core\Json\JsonProperty;

class Conflict extends JsonSerializableType
{
    use BaseError;

    /**
     * @var string $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @param array{
     *   type: string,
     *   message: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->message = $values['message'];
    }
}
