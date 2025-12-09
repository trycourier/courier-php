<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Tokens\UserToken\Device;
use Courier\Users\Tokens\UserToken\ProviderKey;
use Courier\Users\Tokens\UserToken\Tracking;

/**
 * A list of tokens registered with the user.
 *
 * @phpstan-type TokenListResponseShape = array{tokens: list<UserToken>}
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
     * @param list<UserToken|array{
     *   token: string,
     *   providerKey: value-of<ProviderKey>,
     *   device?: Device|null,
     *   expiryDate?: string|bool|null,
     *   properties?: mixed,
     *   tracking?: Tracking|null,
     * }> $tokens
     */
    public static function with(array $tokens): self
    {
        $self = new self;

        $self['tokens'] = $tokens;

        return $self;
    }

    /**
     * @param list<UserToken|array{
     *   token: string,
     *   providerKey: value-of<ProviderKey>,
     *   device?: Device|null,
     *   expiryDate?: string|bool|null,
     *   properties?: mixed,
     *   tracking?: Tracking|null,
     * }> $tokens
     */
    public function withTokens(array $tokens): self
    {
        $self = clone $this;
        $self['tokens'] = $tokens;

        return $self;
    }
}
