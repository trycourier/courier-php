<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class MultipleTokens extends JsonSerializableType
{
    /**
     * @var array<Token> $tokens
     */
    #[JsonProperty('tokens'), ArrayType([Token::class])]
    public array $tokens;

    /**
     * @param array{
     *   tokens: array<Token>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tokens = $values['tokens'];
    }
}
