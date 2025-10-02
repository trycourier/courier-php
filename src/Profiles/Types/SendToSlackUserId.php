<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Profiles\Traits\SlackBaseProperties;
use Courier\Core\Json\JsonProperty;

class SendToSlackUserId extends JsonSerializableType
{
    use SlackBaseProperties;

    /**
     * @var string $userId
     */
    #[JsonProperty('user_id')]
    public string $userId;

    /**
     * @param array{
     *   accessToken: string,
     *   userId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accessToken = $values['accessToken'];
        $this->userId = $values['userId'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
