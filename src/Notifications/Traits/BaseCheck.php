<?php

namespace Courier\Notifications\Traits;

use Courier\Core\Json\JsonProperty;
use Courier\Notifications\Types\CheckStatus;

trait BaseCheck
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var value-of<CheckStatus> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var string $type
     */
    #[JsonProperty('type')]
    public string $type;
}
