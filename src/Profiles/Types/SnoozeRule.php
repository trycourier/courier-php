<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class SnoozeRule extends JsonSerializableType
{
    /**
     * @var value-of<SnoozeRuleType> $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string $start
     */
    #[JsonProperty('start')]
    public string $start;

    /**
     * @var string $until
     */
    #[JsonProperty('until')]
    public string $until;

    /**
     * @param array{
     *   type: value-of<SnoozeRuleType>,
     *   start: string,
     *   until: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->start = $values['start'];
        $this->until = $values['until'];
    }
}
