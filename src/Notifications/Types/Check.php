<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Notifications\Traits\BaseCheck;
use Courier\Core\Json\JsonProperty;

class Check extends JsonSerializableType
{
    use BaseCheck;

    /**
     * @var int $updated
     */
    #[JsonProperty('updated')]
    public int $updated;

    /**
     * @param array{
     *   id: string,
     *   status: value-of<CheckStatus>,
     *   type: 'custom',
     *   updated: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->status = $values['status'];
        $this->type = $values['type'];
        $this->updated = $values['updated'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
