<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationListResponse\Result;
use Courier\Paging;

/**
 * @phpstan-import-type PagingShape from \Courier\Paging
 *
 * @phpstan-type NotificationListResponseShape = array{
 *   paging: Paging|PagingShape, results: list<mixed>
 * }
 */
final class NotificationListResponse implements BaseModel
{
    /** @use SdkModel<NotificationListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<mixed> $results */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * `new NotificationListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationListResponse)->withPaging(...)->withResults(...)
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
     * @param list<mixed> $results
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
     * @param list<mixed> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
