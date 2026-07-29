<?php

declare(strict_types=1);

namespace Courier\Broadcasts;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * Paginated list of broadcasts.
 *
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type BroadcastShape from \Courier\Broadcasts\Broadcast
 *
 * @phpstan-type BroadcastListResponseShape = array{
 *   paging: Paging|PagingShape, results: list<Broadcast|BroadcastShape>
 * }
 */
final class BroadcastListResponse implements BaseModel
{
    /** @use SdkModel<BroadcastListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<Broadcast> $results */
    #[Required(list: Broadcast::class)]
    public array $results;

    /**
     * `new BroadcastListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BroadcastListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BroadcastListResponse)->withPaging(...)->withResults(...)
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
     * @param Paging|PagingShape $paging
     * @param list<Broadcast|BroadcastShape> $results
     */
    public static function with(Paging|array $paging, array $results): self
    {
        $self = new self;

        $self['paging'] = $paging;
        $self['results'] = $results;

        return $self;
    }

    /**
     * @param Paging|PagingShape $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $self = clone $this;
        $self['paging'] = $paging;

        return $self;
    }

    /**
     * @param list<Broadcast|BroadcastShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
