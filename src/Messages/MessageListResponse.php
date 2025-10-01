<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Audiences\Paging;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type message_list_response = array{
 *   paging: Paging, results: list<MessageDetails>
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class MessageListResponse implements BaseModel
{
    /** @use SdkModel<message_list_response> */
    use SdkModel;

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
     * @param list<MessageDetails> $results
     */
    public static function with(Paging $paging, array $results): self
    {
        $obj = new self;

        $obj->paging = $paging;
        $obj->results = $results;

        return $obj;
    }

    /**
     * Paging information for the result set.
     */
    public function withPaging(Paging $paging): self
    {
        $obj = clone $this;
        $obj->paging = $paging;

        return $obj;
    }

    /**
     * An array of messages with their details.
     *
     * @param list<MessageDetails> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj->results = $results;

        return $obj;
    }
}
