<?php

declare(strict_types=1);

namespace Courier\Auth;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Returns a new access token.
 *
 * @see Courier\Services\AuthService::issueToken()
 *
 * @phpstan-type AuthIssueTokenParamsShape = array{
 *   expires_in: string, scope: string
 * }
 */
final class AuthIssueTokenParams implements BaseModel
{
    /** @use SdkModel<AuthIssueTokenParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $expires_in;

    #[Api]
    public string $scope;

    /**
     * `new AuthIssueTokenParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthIssueTokenParams::with(expires_in: ..., scope: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthIssueTokenParams)->withExpiresIn(...)->withScope(...)
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
    public static function with(string $expires_in, string $scope): self
    {
        $obj = new self;

        $obj->expires_in = $expires_in;
        $obj->scope = $scope;

        return $obj;
    }

    public function withExpiresIn(string $expiresIn): self
    {
        $obj = clone $this;
        $obj->expires_in = $expiresIn;

        return $obj;
    }

    public function withScope(string $scope): self
    {
        $obj = clone $this;
        $obj->scope = $scope;

        return $obj;
    }
}
