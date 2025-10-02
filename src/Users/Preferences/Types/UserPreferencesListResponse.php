<?php

namespace Courier\Users\Preferences\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\Paging;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class UserPreferencesListResponse extends JsonSerializableType
{
    /**
     * @var Paging $paging Deprecated - Paging not implemented on this endpoint
     */
    #[JsonProperty('paging')]
    public Paging $paging;

    /**
     * @var array<TopicPreference> $items The Preferences associated with the user_id.
     */
    #[JsonProperty('items'), ArrayType([TopicPreference::class])]
    public array $items;

    /**
     * @param array{
     *   paging: Paging,
     *   items: array<TopicPreference>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paging = $values['paging'];
        $this->items = $values['items'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
