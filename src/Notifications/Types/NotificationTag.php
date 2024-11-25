<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class NotificationTag extends JsonSerializableType
{
    /**
     * @var array<NotificationTagData> $data
     */
    #[JsonProperty('data'), ArrayType([NotificationTagData::class])]
    public array $data;

    /**
     * @param array{
     *   data: array<NotificationTagData>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->data = $values['data'];
    }
}
