<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type JourneyTemplateSummaryShape from \Courier\Journeys\JourneyTemplateSummary
 *
 * @phpstan-type JourneyTemplateListResponseShape = array{
 *   paging: Paging|PagingShape,
 *   results: list<JourneyTemplateSummary|JourneyTemplateSummaryShape>,
 * }
 */
final class JourneyTemplateListResponse implements BaseModel
{
    /** @use SdkModel<JourneyTemplateListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<JourneyTemplateSummary> $results */
    #[Required(list: JourneyTemplateSummary::class)]
    public array $results;

    /**
     * `new JourneyTemplateListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyTemplateListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyTemplateListResponse)->withPaging(...)->withResults(...)
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
     * @param list<JourneyTemplateSummary|JourneyTemplateSummaryShape> $results
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
     * @param list<JourneyTemplateSummary|JourneyTemplateSummaryShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
