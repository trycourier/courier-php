<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendToSlackEmailShape = array{accessToken: string, email: string}
 */
final class SendToSlackEmail implements BaseModel
{
    /** @use SdkModel<SendToSlackEmailShape> */
    use SdkModel;

    #[Required('access_token')]
    public string $accessToken;

    #[Required]
    public string $email;

    /**
     * `new SendToSlackEmail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendToSlackEmail::with(accessToken: ..., email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendToSlackEmail)->withAccessToken(...)->withEmail(...)
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
    public static function with(string $accessToken, string $email): self
    {
        $self = new self;

        $self['accessToken'] = $accessToken;
        $self['email'] = $email;

        return $self;
    }

    public function withAccessToken(string $accessToken): self
    {
        $self = clone $this;
        $self['accessToken'] = $accessToken;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }
}
