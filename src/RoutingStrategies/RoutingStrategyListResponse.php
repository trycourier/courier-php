<?php

declare(strict_types=1);

namespace Courier\RoutingStrategies;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * Paginated list of routing strategy summaries.
 *
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type RoutingStrategySummaryShape from \Courier\RoutingStrategies\RoutingStrategySummary
 *
 * @phpstan-type RoutingStrategyListResponseShape = array{
 *   paging: Paging|PagingShape,
 *   results: list<RoutingStrategySummary|RoutingStrategySummaryShape>,
 * }
 */
final class RoutingStrategyListResponse implements BaseModel
{
    /** @use SdkModel<RoutingStrategyListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<RoutingStrategySummary> $results */
    #[Required(list: RoutingStrategySummary::class)]
    public array $results;

    /**
     * `new RoutingStrategyListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingStrategyListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingStrategyListResponse)->withPaging(...)->withResults(...)
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
     * @param list<RoutingStrategySummary|RoutingStrategySummaryShape> $results
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
     * @param list<RoutingStrategySummary|RoutingStrategySummaryShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
