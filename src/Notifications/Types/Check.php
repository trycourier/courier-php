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
     *   updated: int,
     *   id: string,
     *   status: value-of<CheckStatus>,
     *   type: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->updated = $values['updated'];
        $this->id = $values['id'];
        $this->status = $values['status'];
        $this->type = $values['type'];
    }
}
