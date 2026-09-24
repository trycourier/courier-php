<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * Paginated list of preview runs, newest first.
 *
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type PreviewRunShape from \Courier\Notifications\Previews\Runs\PreviewRun
 *
 * @phpstan-type PreviewRunListResponseShape = array{
 *   paging: Paging|PagingShape, results: list<PreviewRun|PreviewRunShape>
 * }
 */
final class PreviewRunListResponse implements BaseModel
{
    /** @use SdkModel<PreviewRunListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<PreviewRun> $results */
    #[Required(list: PreviewRun::class)]
    public array $results;

    /**
     * `new PreviewRunListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewRunListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewRunListResponse)->withPaging(...)->withResults(...)
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
     * @param list<PreviewRun|PreviewRunShape> $results
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
     * @param list<PreviewRun|PreviewRunShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
