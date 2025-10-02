<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

/**
 * Defines what items should be retained and passed along to the next steps when the batch is released
 */
class AutomationAddToBatchRetain extends JsonSerializableType
{
    /**
     * Keep N number of notifications based on the type. First/Last N based on notification received.
     * highest/lowest based on a scoring key providing in the data accessed by sort_key
     *
     * @var value-of<AutomationAddToBatchRetainType> $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * The number of records to keep in batch. Default is 10 and only configurable by requesting from support.
     * When configurable minimum is 2 and maximum is 100.
     *
     * @var int $count
     */
    #[JsonProperty('count')]
    public int $count;

    /**
     * @var ?string $sortKey Defines the data value data[sort_key] that is used to sort the stored items. Required when type is set to highest or lowest.
     */
    #[JsonProperty('sort_key')]
    public ?string $sortKey;

    /**
     * @param array{
     *   type: value-of<AutomationAddToBatchRetainType>,
     *   count: int,
     *   sortKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->count = $values['count'];
        $this->sortKey = $values['sortKey'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
