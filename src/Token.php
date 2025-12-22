<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type TokenShape = array{token: string}
 */
final class Token implements BaseModel
{
    /** @use SdkModel<TokenShape> */
    use SdkModel;

    #[Required]
    public string $token;

    /**
     * `new Token()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Token::with(token: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Token)->withToken(...)
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
     */
    public static function with(string $token): self
    {
        $self = new self;

        $self['token'] = $token;

        return $self;
    }

    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }
}
