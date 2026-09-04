<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\TokenUpdateParams;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Tokens\TokenUpdateParams\Patch\Value;

/**
 * @phpstan-import-type ValueVariants from \Courier\Users\Tokens\TokenUpdateParams\Patch\Value
 * @phpstan-import-type ValueShape from \Courier\Users\Tokens\TokenUpdateParams\Patch\Value
 *
 * @phpstan-type PatchShape = array{
 *   op: string, path: string, value?: ValueShape|null
 * }
 */
final class Patch implements BaseModel
{
    /** @use SdkModel<PatchShape> */
    use SdkModel;

    /**
     * The operation to perform.
     */
    #[Required]
    public string $op;

    /**
     * The JSON path specifying the part of the profile to operate on.
     */
    #[Required]
    public string $path;

    /**
     * The value for the operation. A string for most fields; boolean `false` when disabling token expiration via `expiry_date`, which cannot be expressed as a string.
     *
     * @var ValueVariants|null $value
     */
    #[Optional(union: Value::class, nullable: true)]
    public string|bool|array|null $value;

    /**
     * `new Patch()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Patch::with(op: ..., path: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Patch)->withOp(...)->withPath(...)
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
     * @param ValueShape|null $value
     */
    public static function with(
        string $op,
        string $path,
        string|bool|array|null $value = null
    ): self {
        $self = new self;

        $self['op'] = $op;
        $self['path'] = $path;

        null !== $value && $self['value'] = $value;

        return $self;
    }

    /**
     * The operation to perform.
     */
    public function withOp(string $op): self
    {
        $self = clone $this;
        $self['op'] = $op;

        return $self;
    }

    /**
     * The JSON path specifying the part of the profile to operate on.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * The value for the operation. A string for most fields; boolean `false` when disabling token expiration via `expiry_date`, which cannot be expressed as a string.
     *
     * @param ValueShape|null $value
     */
    public function withValue(string|bool|array|null $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
