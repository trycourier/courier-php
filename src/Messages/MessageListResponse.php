<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Messages\MessageDetails\Reason;
use Courier\Messages\MessageDetails\Status;
use Courier\Paging;

/**
 * @phpstan-type MessageListResponseShape = array{
 *   paging: Paging, results: list<MessageDetails>
 * }
 */
final class MessageListResponse implements BaseModel
{
    /** @use SdkModel<MessageListResponseShape> */
    use SdkModel;

    /**
     * Paging information for the result set.
     */
    #[Required]
    public Paging $paging;

    /**
     * An array of messages with their details.
     *
     * @var list<MessageDetails> $results
     */
    #[Required(list: MessageDetails::class)]
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
        $self = new self;

        $self['paging'] = $paging;
        $self['results'] = $results;

        return $self;
    }

    /**
     * Paging information for the result set.
     *
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $self = clone $this;
        $self['paging'] = $paging;

        return $self;
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
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
