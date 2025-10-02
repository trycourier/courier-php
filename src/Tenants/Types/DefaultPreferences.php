<?php

namespace Courier\Tenants\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class DefaultPreferences extends JsonSerializableType
{
    /**
     * @var ?array<SubscriptionTopic> $items
     */
    #[JsonProperty('items'), ArrayType([SubscriptionTopic::class])]
    public ?array $items;

    /**
     * @param array{
     *   items?: ?array<SubscriptionTopic>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->items = $values['items'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
