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
     *   accessToken: string,
     *   email: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accessToken = $values['accessToken'];
        $this->email = $values['email'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
