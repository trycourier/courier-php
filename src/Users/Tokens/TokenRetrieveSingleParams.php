<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new TokenRetrieveSingleParams); // set properties as needed
 * $client->users.tokens->retrieveSingle(...$params->toArray());
 * ```
 * Get single token available for a `:token`.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->users.tokens->retrieveSingle(...$params->toArray());`
 *
 * @see Courier\Users\Tokens->retrieveSingle
 *
 * @phpstan-type token_retrieve_single_params = array{userID: string}
 */
final class TokenRetrieveSingleParams implements BaseModel
{
    /** @use SdkModel<token_retrieve_single_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $userID;

    /**
     * `new TokenRetrieveSingleParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenRetrieveSingleParams::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenRetrieveSingleParams)->withUserID(...)
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
