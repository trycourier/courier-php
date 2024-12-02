<?php

namespace Courier\Commons\Traits;

use Courier\Core\Json\JsonProperty;

trait BaseError
{
    /**
     * @var string $message A message describing the error that occurred.
     */
    #[JsonProperty('message')]
    public string $message;
}
