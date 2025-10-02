<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Types\Pagerduty;
use Courier\Core\Json\JsonProperty;

class PagerdutyRecipient extends JsonSerializableType
{
    /**
     * @var Pagerduty $pagerduty
     */
    #[JsonProperty('pagerduty')]
    public Pagerduty $pagerduty;

    /**
     * @param array{
     *   pagerduty: Pagerduty,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->pagerduty = $values['pagerduty'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
