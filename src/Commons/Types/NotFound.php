<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Traits\BaseError;
use Courier\Core\Json\JsonProperty;

class NotFound extends JsonSerializableType
{
    use BaseError;

    /**
     * @var 'invalid_request_error' $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @param array{
     *   message: string,
     *   type: 'invalid_request_error',
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->message = $values['message'];
        $this->type = $values['type'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
