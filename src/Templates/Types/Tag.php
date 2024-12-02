<?php

namespace Courier\Templates\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class Tag extends JsonSerializableType
{
    /**
     * @var array<TagData> $data
     */
    #[JsonProperty('data'), ArrayType([TagData::class])]
    public array $data;

    /**
     * @param array{
     *   data: array<TagData>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->data = $values['data'];
    }
}
