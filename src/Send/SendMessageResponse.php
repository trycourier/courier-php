<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type SendMessageResponseShape = array{requestId: string}
 */
final class SendMessageResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<SendMessageResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * A successful call to `POST /send` returns a `202` status code along with a `requestId` in the response body.
     * For single-recipient requests, the `requestId` is the derived message_id. For multiple recipients, Courier assigns a unique message_id to each derived message.
     */
    #[Api]
    public string $requestId;

    /**
     * `new SendMessageResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendMessageResponse::with(requestId: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendMessageResponse)->withRequestID(...)
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
    public static function with(string $requestId): self
    {
        $obj = new self;

        $obj->requestId = $requestId;

        return $obj;
    }

    /**
     * A successful call to `POST /send` returns a `202` status code along with a `requestId` in the response body.
     * For single-recipient requests, the `requestId` is the derived message_id. For multiple recipients, Courier assigns a unique message_id to each derived message.
     */
    public function withRequestID(string $requestID): self
    {
        $obj = clone $this;
        $obj->requestId = $requestID;

        return $obj;
    }
}
