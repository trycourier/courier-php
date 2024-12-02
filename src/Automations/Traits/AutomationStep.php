<?php

namespace Courier\Automations\Traits;

use Courier\Core\Json\JsonProperty;

trait AutomationStep
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
}
