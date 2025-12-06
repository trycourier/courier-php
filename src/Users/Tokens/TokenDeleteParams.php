<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Delete User Token.
 *
 * @see Courier\Services\Users\TokensService::delete()
 *
 * @phpstan-type TokenDeleteParamsShape = array{user_id: string}
 */
final class TokenDeleteParams implements BaseModel
{
    /** @use SdkModel<TokenDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $user_id;

    /**
     * `new TokenDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenDeleteParams::with(user_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenDeleteParams)->withUserID(...)
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
    public static function with(string $user_id): self
    {
        $obj = new self;

        $obj['user_id'] = $user_id;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj['user_id'] = $userID;

        return $obj;
    }
}
