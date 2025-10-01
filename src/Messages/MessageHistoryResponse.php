<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\MapOf;

/**
 * @phpstan-type message_history_response = array{
 *   results: list<array<string, mixed>>
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class MessageHistoryResponse implements BaseModel
{
    /** @use SdkModel<message_history_response> */
    use SdkModel;

    /** @var list<array<string, mixed>> $results */
    #[Api(list: new MapOf('mixed'))]
    public array $results;

    /**
     * `new MessageHistoryResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageHistoryResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageHistoryResponse)->withResults(...)
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
     * @param list<array<string, mixed>> $results
     */
    public static function with(array $results): self
    {
        $obj = new self;

        $obj->results = $results;

        return $obj;
    }

    /**
     * @param list<array<string, mixed>> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj->results = $results;

        return $obj;
    }
}
