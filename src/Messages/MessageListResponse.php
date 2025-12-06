<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Messages\MessageDetails\Reason;
use Courier\Messages\MessageDetails\Status;
use Courier\Paging;

/**
 * @phpstan-type MessageListResponseShape = array{
 *   paging: Paging, results: list<MessageDetails>
 * }
 */
final class MessageListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<MessageListResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Paging information for the result set.
     */
    #[Api]
    public Paging $paging;

    /**
     * An array of messages with their details.
     *
     * @var list<MessageDetails> $results
     */
    #[Api(list: MessageDetails::class)]
    public array $results;

    /**
     * `new MessageListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageListResponse)->withPaging(...)->withResults(...)
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
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     * @param list<MessageDetails|array{
     *   id: string,
     *   clicked: int,
     *   delivered: int,
     *   enqueued: int,
     *   event: string,
     *   notification: string,
     *   opened: int,
     *   recipient: string,
     *   sent: int,
     *   status: value-of<Status>,
     *   error?: string|null,
     *   reason?: value-of<Reason>|null,
     * }> $results
     */
    public static function with(Paging|array $paging, array $results): self
    {
        $obj = new self;

        $obj['paging'] = $paging;
        $obj['results'] = $results;

        return $obj;
    }

    /**
     * Paging information for the result set.
     *
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $obj = clone $this;
        $obj['paging'] = $paging;

        return $obj;
    }

    /**
     * An array of messages with their details.
     *
     * @param list<MessageDetails|array{
     *   id: string,
     *   clicked: int,
     *   delivered: int,
     *   enqueued: int,
     *   event: string,
     *   notification: string,
     *   opened: int,
     *   recipient: string,
     *   sent: int,
     *   status: value-of<Status>,
     *   error?: string|null,
     *   reason?: value-of<Reason>|null,
     * }> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj['results'] = $results;

        return $obj;
    }
}
