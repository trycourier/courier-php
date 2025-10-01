<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type paging_alias = array{more: bool, cursor?: string|null}
 */
final class Paging implements BaseModel
{
    /** @use SdkModel<paging_alias> */
    use SdkModel;

    #[Api]
    public bool $more;

    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    /**
     * `new Paging()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Paging::with(more: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Paging)->withMore(...)
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
    public static function with(bool $more, ?string $cursor = null): self
    {
        $obj = new self;

        $obj->more = $more;

        null !== $cursor && $obj->cursor = $cursor;

        return $obj;
    }

    public function withMore(bool $more): self
    {
        $obj = clone $this;
        $obj->more = $more;

        return $obj;
    }

    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }
}
