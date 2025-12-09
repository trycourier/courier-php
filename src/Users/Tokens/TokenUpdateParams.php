<?php

declare(strict_types=1);

namespace Courier\Users\Tokens;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Tokens\TokenUpdateParams\Patch;

/**
 * Apply a JSON Patch (RFC 6902) to the specified token.
 *
 * @see Courier\Services\Users\TokensService::update()
 *
 * @phpstan-type TokenUpdateParamsShape = array{
 *   userID: string,
 *   patch: list<Patch|array{op: string, path: string, value?: string|null}>,
 * }
 */
final class TokenUpdateParams implements BaseModel
{
    /** @use SdkModel<TokenUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

    /** @var list<Patch> $patch */
    #[Required(list: Patch::class)]
    public array $patch;

    /**
     * `new TokenUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenUpdateParams::with(userID: ..., patch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenUpdateParams)->withUserID(...)->withPatch(...)
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
     * @param list<Patch|array{op: string, path: string, value?: string|null}> $patch
     */
    public static function with(string $userID, array $patch): self
    {
        $obj = new self;

        $obj['userID'] = $userID;
        $obj['patch'] = $patch;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj['userID'] = $userID;

        return $obj;
    }

    /**
     * @param list<Patch|array{op: string, path: string, value?: string|null}> $patch
     */
    public function withPatch(array $patch): self
    {
        $obj = clone $this;
        $obj['patch'] = $patch;

        return $obj;
    }
}
