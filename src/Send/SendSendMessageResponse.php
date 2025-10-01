<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type send_send_message_response = array{requestID: string}
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class SendSendMessageResponse implements BaseModel
{
    /** @use SdkModel<send_send_message_response> */
    use SdkModel;

    /**
     * A successful call to `POST /send` returns a `202` status code along with a `requestId` in the response body.
     *
     * For send requests that have a single recipient, the `requestId` is assigned to the derived message as its message_id. Therefore the `requestId` can be supplied to the Message's API for single recipient messages.
     *
     * For send requests that have multiple recipients (accounts, audiences, lists, etc.), Courier assigns a unique id to each derived message as its `message_id`. Therefore the `requestId` cannot be supplied to the Message's API for single-recipient messages.
     */
    #[Api('requestId')]
    public string $requestID;

    /**
     * `new SendSendMessageResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendSendMessageResponse::with(requestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendSendMessageResponse)->withRequestID(...)
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
     */
    public static function with(string $requestID): self
    {
        $obj = new self;

        $obj->requestID = $requestID;

        return $obj;
    }

    /**
     * A successful call to `POST /send` returns a `202` status code along with a `requestId` in the response body.
     *
     * For send requests that have a single recipient, the `requestId` is assigned to the derived message as its message_id. Therefore the `requestId` can be supplied to the Message's API for single recipient messages.
     *
     * For send requests that have multiple recipients (accounts, audiences, lists, etc.), Courier assigns a unique id to each derived message as its `message_id`. Therefore the `requestId` cannot be supplied to the Message's API for single-recipient messages.
     */
    public function withRequestID(string $requestID): self
    {
        $obj = clone $this;
        $obj->requestID = $requestID;

        return $obj;
    }
}
