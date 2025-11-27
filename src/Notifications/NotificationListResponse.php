<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Notifications\NotificationListResponse\Result;
use Courier\Paging;

/**
 * @phpstan-type NotificationListResponseShape = array{
 *   paging: Paging, results: list<mixed>
 * }
 */
final class NotificationListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<NotificationListResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public Paging $paging;

    /** @var list<mixed> $results */
    #[Api(list: Result::class)]
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
     * @param list<mixed> $results
     */
    public static function with(Paging $paging, array $results): self
    {
        $obj = new self;

        $obj->paging = $paging;
        $obj->results = $results;

        return $obj;
    }

    public function withPaging(Paging $paging): self
    {
        $obj = clone $this;
        $obj->paging = $paging;

        return $obj;
    }

    /**
     * @param list<mixed> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj->results = $results;

        return $obj;
    }
}
