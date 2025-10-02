<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class MergeProfileResponse extends JsonSerializableType
{
    /**
     * @var 'SUCCESS' $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @param array{
     *   status: 'SUCCESS',
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
