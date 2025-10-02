<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AutomationThrottleOnThrottle extends JsonSerializableType
{
    /**
     * @var string $nodeId The node to go to if the request is throttled
     */
    #[JsonProperty('$node_id')]
    public string $nodeId;

    /**
     * @param array{
     *   nodeId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->nodeId = $values['nodeId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
