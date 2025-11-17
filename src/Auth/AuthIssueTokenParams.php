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

    /**
     * Duration for token expiration. Accepts various time formats: - "2 hours" - 2 hours from now - "1d" - 1 day - "10h" - 10 hours - "2.5 hrs" - 2.5 hours - "1m" - 1 minute - "5s" - 5 seconds - "1y" - 1 year.
     */
    #[Api]
    public string $expires_in;

    /**
     * Space-separated list of scopes that define what the token can access. Common scopes include:
     * Inbox Auth: - user_id:<user-id> - Access to a specific user (multiple can be listed) - read:messages - Read messages (requires user_id scope) - inbox:read:messages - Read inbox messages - inbox:write:events - Write inbox events (mark as read, etc.)
     * Preferences Auth: - read:preferences - Read user preferences - write:preferences - Write user preferences
     * Brands Auth: - read:brands[:<brand_id>] - Read brands (optionally specific brand) - write:brands[:<brand_id>] - Write brands (optionally specific brand)
     * Example: "user_id:user123 inbox:read:messages inbox:write:events"
     */
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

    /**
     * Duration for token expiration. Accepts various time formats: - "2 hours" - 2 hours from now - "1d" - 1 day - "10h" - 10 hours - "2.5 hrs" - 2.5 hours - "1m" - 1 minute - "5s" - 5 seconds - "1y" - 1 year.
     */
    public function withExpiresIn(string $expiresIn): self
    {
        $obj = clone $this;
        $obj->expires_in = $expiresIn;

        return $obj;
    }

    /**
     * Space-separated list of scopes that define what the token can access. Common scopes include:
     * Inbox Auth: - user_id:<user-id> - Access to a specific user (multiple can be listed) - read:messages - Read messages (requires user_id scope) - inbox:read:messages - Read inbox messages - inbox:write:events - Write inbox events (mark as read, etc.)
     * Preferences Auth: - read:preferences - Read user preferences - write:preferences - Write user preferences
     * Brands Auth: - read:brands[:<brand_id>] - Read brands (optionally specific brand) - write:brands[:<brand_id>] - Write brands (optionally specific brand)
     * Example: "user_id:user123 inbox:read:messages inbox:write:events"
     */
    public function withScope(string $scope): self
    {
        $obj = clone $this;
        $obj->scope = $scope;

        return $obj;
    }
}
