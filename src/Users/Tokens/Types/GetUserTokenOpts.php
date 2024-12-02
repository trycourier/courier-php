<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class GetUserTokenOpts extends JsonSerializableType
{
    /**
     * @var string $userId
     */
    #[JsonProperty('user_id')]
    public string $userId;

    /**
     * @var string $token
     */
    #[JsonProperty('token')]
    public string $token;

    /**
     * @param array{
     *   userId: string,
     *   token: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->token = $values['token'];
    }
}
