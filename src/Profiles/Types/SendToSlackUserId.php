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
     *   userId: string,
     *   accessToken: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->accessToken = $values['accessToken'];
    }
}
