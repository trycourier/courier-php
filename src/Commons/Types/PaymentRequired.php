<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Traits\BaseError;
use Courier\Core\Json\JsonProperty;

class PaymentRequired extends JsonSerializableType
{
    use BaseError;

    /**
     * @var 'authorization_error' $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @param array{
     *   message: string,
     *   type: 'authorization_error',
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
