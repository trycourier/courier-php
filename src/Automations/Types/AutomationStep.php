<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AutomationStep extends JsonSerializableType
{
    /**
     * @var ?string $if
     */
    #[JsonProperty('if')]
    public ?string $if;

    /**
     * @var ?string $ref
     */
    #[JsonProperty('ref')]
    public ?string $ref;

    /**
     * @param array{
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
    }
}
