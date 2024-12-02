<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class Preferences extends JsonSerializableType
{
    /**
     * @var array<string> $templateIds
     */
    #[JsonProperty('templateIds'), ArrayType(['string'])]
    public array $templateIds;

    /**
     * @param array{
     *   templateIds: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->templateIds = $values['templateIds'];
    }
}
