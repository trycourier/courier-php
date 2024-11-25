<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class SubscribeToListsRequest extends JsonSerializableType
{
    /**
     * @var array<SubscribeToListsRequestListObject> $lists
     */
    #[JsonProperty('lists'), ArrayType([SubscribeToListsRequestListObject::class])]
    public array $lists;

    /**
     * @param array{
     *   lists: array<SubscribeToListsRequestListObject>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->lists = $values['lists'];
    }
}
