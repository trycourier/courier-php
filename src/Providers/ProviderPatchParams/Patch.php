<?php

declare(strict_types=1);

namespace Courier\Providers\ProviderPatchParams;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Providers\ProviderPatchParams\Patch\Op;

/**
 * One JSON Patch (RFC 6902) operation.
 *
 * @phpstan-type PatchShape = array{
 *   op: Op|value-of<Op>, path: string, from?: string|null, value?: mixed
 * }
 */
final class Patch implements BaseModel
{
    /** @use SdkModel<PatchShape> */
    use SdkModel;

    /**
     * The operation to perform.
     *
     * @var value-of<Op> $op
     */
    #[Required(enum: Op::class)]
    public string $op;

    /**
     * JSON Pointer to the field to operate on, such as `/settings/api_key`.
     */
    #[Required]
    public string $path;

    /**
     * JSON Pointer to the source field for `move` and `copy`.
     */
    #[Optional]
    public ?string $from;

    /**
     * The value for `add`, `replace` and `test`. Any JSON value.
     */
    #[Optional]
    public mixed $value;

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
     * @param Op|value-of<Op> $op
     */
    public static function with(
        Op|string $op,
        string $path,
        ?string $from = null,
        mixed $value = null
    ): self {
        $self = new self;

        $self['op'] = $op;
        $self['path'] = $path;

        null !== $from && $self['from'] = $from;
        null !== $value && $self['value'] = $value;

        return $self;
    }

    /**
     * The operation to perform.
     *
     * @param Op|value-of<Op> $op
     */
    public function withOp(Op|string $op): self
    {
        $self = clone $this;
        $self['op'] = $op;

        return $self;
    }

    /**
     * JSON Pointer to the field to operate on, such as `/settings/api_key`.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * JSON Pointer to the source field for `move` and `copy`.
     */
    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * The value for `add`, `replace` and `test`. Any JSON value.
     */
    public function withValue(mixed $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
