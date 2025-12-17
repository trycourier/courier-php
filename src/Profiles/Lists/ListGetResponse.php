<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;
use Courier\Profiles\Lists\ListGetResponse\Result;

/**
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type ResultShape from \Courier\Profiles\Lists\ListGetResponse\Result
 *
 * @phpstan-type ListGetResponseShape = array{
 *   paging: Paging|PagingShape, results: list<ResultShape>
 * }
 */
final class ListGetResponse implements BaseModel
{
    /** @use SdkModel<ListGetResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /**
     * An array of lists.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * `new ListGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ListGetResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ListGetResponse)->withPaging(...)->withResults(...)
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
     * @param PagingShape $paging
     * @param list<ResultShape> $results
     */
    public static function with(Paging|array $paging, array $results): self
    {
        $self = new self;

        $self['paging'] = $paging;
        $self['results'] = $results;

        return $self;
    }

    /**
     * @param PagingShape $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $self = clone $this;
        $self['paging'] = $paging;

        return $self;
    }

    /**
     * An array of lists.
     *
     * @param list<ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
