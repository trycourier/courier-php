<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Traits\SlackBaseProperties;
use Courier\Core\Json\JsonProperty;

class SendToSlackEmail extends JsonSerializableType
{
    use SlackBaseProperties;

    /**
     * @var string $email
     */
    #[JsonProperty('email')]
    public string $email;

    /**
     * @param array{
     *   email: string,
     *   accessToken: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->email = $values['email'];
        $this->accessToken = $values['accessToken'];
    }
}
