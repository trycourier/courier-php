<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get single token available for a `:token`.
 *
 * @see Courier\Users\Tokens->retrieve
 *
 * @phpstan-type TokenRetrieveParamsShape = array{userID: string}
 */
final class TokenRetrieveParams implements BaseModel
{
    /** @use SdkModel<TokenRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $userID;

    /**
     * `new TokenRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenRetrieveParams::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenRetrieveParams)->withUserID(...)
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
    public static function with(string $userID): self
    {
        $obj = new self;

        $obj->userID = $userID;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }
}
