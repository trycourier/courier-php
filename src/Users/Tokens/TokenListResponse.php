<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A list of tokens registered with the user.
 *
 * @phpstan-import-type UserTokenShape from \Courier\Users\Tokens\UserToken
 *
 * @phpstan-type TokenListResponseShape = array{
 *   tokens: list<UserToken|UserTokenShape>
 * }
 */
final class TokenListResponse implements BaseModel
{
    /** @use SdkModel<TokenListResponseShape> */
    use SdkModel;

    /** @var list<UserToken> $tokens */
    #[Required(list: UserToken::class)]
    public array $tokens;

    /**
     * `new TokenListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenListResponse::with(tokens: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenListResponse)->withTokens(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<UserToken|UserTokenShape> $tokens
     */
    public static function with(array $tokens): self
    {
        $self = new self;

        $self['tokens'] = $tokens;

        return $self;
    }

    /**
     * @param list<UserToken|UserTokenShape> $tokens
     */
    public function withTokens(array $tokens): self
    {
        $self = clone $this;
        $self['tokens'] = $tokens;

        return $self;
    }
}
