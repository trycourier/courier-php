<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Messages\MessageContentResponse\Result;

/**
 * @phpstan-type message_content_response = array{results: list<Result>}
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class MessageContentResponse implements BaseModel
{
    /** @use SdkModel<message_content_response> */
    use SdkModel;

    /**
     * An array of render output of a previously sent message.
     *
     * @var list<Result> $results
     */
    #[Api(list: Result::class)]
    public array $results;

    /**
     * `new MessageContentResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageContentResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageContentResponse)->withResults(...)
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
     * @param list<Result> $results
     */
    public static function with(array $results): self
    {
        $obj = new self;

        $obj->results = $results;

        return $obj;
    }

    /**
     * An array of render output of a previously sent message.
     *
     * @param list<Result> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj->results = $results;

        return $obj;
    }
}
