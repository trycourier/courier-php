<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class GetUserTokensOpts extends JsonSerializableType
{
    /**
     * @var string $userId
     */
    #[JsonProperty('user_id')]
    public string $userId;

    /**
     * @param array{
     *   userId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
    }
}
