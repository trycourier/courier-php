<?php

namespace Courier\Notifications\Traits;

use Courier\Notifications\Types\CheckStatus;
use Courier\Core\Json\JsonProperty;

/**
 * @property string $id
 * @property value-of<CheckStatus> $status
 * @property 'custom' $type
 */
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
     * @var 'custom' $type
     */
    #[JsonProperty('type')]
    public string $type;
}
