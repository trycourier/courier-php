<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MultipleTokens\Tokens;

/**
 * @phpstan-import-type TokensVariants from \Courier\MultipleTokens\Tokens
 * @phpstan-import-type TokensShape from \Courier\MultipleTokens\Tokens
 *
 * @phpstan-type MultipleTokensShape = array{tokens: TokensShape}
 */
final class MultipleTokens implements BaseModel
{
    /** @use SdkModel<MultipleTokensShape> */
    use SdkModel;

    /**
     * One device token, or an array of them. The values are the token strings themselves — not objects.
     *
     * @var TokensVariants $tokens
     */
    #[Required(union: Tokens::class)]
    public string|array $tokens;

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
     * @param TokensShape $tokens
     */
    public static function with(string|array $tokens): self
    {
        $self = new self;

        $self['tokens'] = $tokens;

        return $self;
    }

    /**
     * One device token, or an array of them. The values are the token strings themselves — not objects.
     *
     * @param TokensShape $tokens
     */
    public function withTokens(string|array $tokens): self
    {
        $self = clone $this;
        $self['tokens'] = $tokens;

        return $self;
    }
}
