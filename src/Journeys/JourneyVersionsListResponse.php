<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * Paged list of published journey versions, most recent first.
 *
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type JourneyVersionItemShape from \Courier\Journeys\JourneyVersionItem
 *
 * @phpstan-type JourneyVersionsListResponseShape = array{
 *   paging: Paging|PagingShape,
 *   results: list<JourneyVersionItem|JourneyVersionItemShape>,
 * }
 */
final class JourneyVersionsListResponse implements BaseModel
{
    /** @use SdkModel<JourneyVersionsListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<JourneyVersionItem> $results */
    #[Required(list: JourneyVersionItem::class)]
    public array $results;

    /**
     * `new JourneyVersionsListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyVersionsListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyVersionsListResponse)->withPaging(...)->withResults(...)
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
     * @param list<JourneyVersionItem|JourneyVersionItemShape> $results
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
     * @param list<JourneyVersionItem|JourneyVersionItemShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
