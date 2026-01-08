<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type TokenShape from \Courier\Token
 *
 * @phpstan-type MultipleTokensShape = array{tokens: list<Token|TokenShape>}
 */
final class MultipleTokens implements BaseModel
{
    /** @use SdkModel<MultipleTokensShape> */
    use SdkModel;

    /** @var list<Token> $tokens */
    #[Required(list: Token::class)]
    public array $tokens;

    /**
     * `new MultipleTokens()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MultipleTokens::with(tokens: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MultipleTokens)->withTokens(...)
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
     * @param list<Token|TokenShape> $tokens
     */
    public static function with(array $tokens): self
    {
        $self = new self;

        $self['tokens'] = $tokens;

        return $self;
    }

    /**
     * @param list<Token|TokenShape> $tokens
     */
    public function withTokens(array $tokens): self
    {
        $self = clone $this;
        $self['tokens'] = $tokens;

        return $self;
    }
}
