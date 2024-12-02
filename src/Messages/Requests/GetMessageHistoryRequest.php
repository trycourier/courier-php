<?php

namespace Courier\Messages\Requests;

use Courier\Core\Json\JsonSerializableType;

class GetMessageHistoryRequest extends JsonSerializableType
{
    /**
     * @var ?string $type A supported Message History type that will filter the events returned.
     */
    public ?string $type;

    /**
     * @param array{
     *   type?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
    }
}
