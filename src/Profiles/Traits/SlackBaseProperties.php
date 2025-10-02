<?php

namespace Courier\Profiles\Traits;

use Courier\Core\Json\JsonProperty;

/**
 * @property string $accessToken
 */
trait SlackBaseProperties
{
    /**
     * @var string $accessToken
     */
    #[JsonProperty('access_token')]
    public string $accessToken;
}
