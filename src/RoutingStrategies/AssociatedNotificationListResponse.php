<?php

declare(strict_types=1);

namespace Courier\RoutingStrategies;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationTemplateSummary;
use Courier\Paging;

/**
 * Paginated list of notification templates associated with a routing strategy.
 *
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type NotificationTemplateSummaryShape from \Courier\Notifications\NotificationTemplateSummary
 *
 * @phpstan-type AssociatedNotificationListResponseShape = array{
 *   paging: Paging|PagingShape,
 *   results: list<NotificationTemplateSummary|NotificationTemplateSummaryShape>,
 * }
 */
final class AssociatedNotificationListResponse implements BaseModel
{
    /** @use SdkModel<AssociatedNotificationListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<NotificationTemplateSummary> $results */
    #[Required(list: NotificationTemplateSummary::class)]
    public array $results;

    /**
     * `new AssociatedNotificationListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssociatedNotificationListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssociatedNotificationListResponse)->withPaging(...)->withResults(...)
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
     * @param list<NotificationTemplateSummary|NotificationTemplateSummaryShape> $results
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
     * @param list<NotificationTemplateSummary|NotificationTemplateSummaryShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
