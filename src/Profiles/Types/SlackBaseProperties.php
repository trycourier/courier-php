<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class SlackBaseProperties extends JsonSerializableType
{
    /**
     * @var string $accessToken
     */
    #[JsonProperty('access_token')]
    public string $accessToken;

    /**
     * @param array{
     *   accessToken: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accessToken = $values['accessToken'];
    }
}
