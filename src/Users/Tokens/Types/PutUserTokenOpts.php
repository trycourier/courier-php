<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class PutUserTokenOpts extends JsonSerializableType
{
    /**
     * @var string $userId
     */
    #[JsonProperty('user_id')]
    public string $userId;

    /**
     * @var UserToken $token
     */
    #[JsonProperty('token')]
    public UserToken $token;

    /**
     * @param array{
     *   userId: string,
     *   token: UserToken,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->token = $values['token'];
    }
}
