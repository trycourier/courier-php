<?php

namespace Courier\Users\Tokens\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class PutUserTokensOpts extends JsonSerializableType
{
    /**
     * @var string $userId
     */
    #[JsonProperty('user_id')]
    public string $userId;

    /**
     * @var array<UserToken> $tokens
     */
    #[JsonProperty('tokens'), ArrayType([UserToken::class])]
    public array $tokens;

    /**
     * @param array{
     *   userId: string,
     *   tokens: array<UserToken>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->tokens = $values['tokens'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
