<?php

declare(strict_types=1);

namespace Courier\Auth;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AuthIssueTokenResponseShape = array{token: string}
 */
final class AuthIssueTokenResponse implements BaseModel
{
    /** @use SdkModel<AuthIssueTokenResponseShape> */
    use SdkModel;

    #[Api]
    public string $token;

    /**
     * `new AuthIssueTokenResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthIssueTokenResponse::with(token: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthIssueTokenResponse)->withToken(...)
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
        $obj = new self;

        $obj['token'] = $token;

        return $obj;
    }

    public function withToken(string $token): self
    {
        $obj = clone $this;
        $obj['token'] = $token;

        return $obj;
    }
}
