<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class DeleteListSubscriptionResponse extends JsonSerializableType
{
    /**
     * @var string $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @param array{
     *   status: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
    }
}
