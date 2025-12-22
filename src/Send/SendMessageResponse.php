<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendMessageResponseShape = array{requestID: string}
 */
final class SendMessageResponse implements BaseModel
{
    /** @use SdkModel<SendMessageResponseShape> */
    use SdkModel;

    /**
     * A successful call to `POST /send` returns a `202` status code along with a `requestId` in the response body.
     * For single-recipient requests, the `requestId` is the derived message_id. For multiple recipients, Courier assigns a unique message_id to each derived message.
     */
    #[Required('requestId')]
    public string $requestID;

    /**
     * `new SendMessageResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendMessageResponse::with(requestID: ...)
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
    public static function with(string $requestID): self
    {
        $self = new self;

        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * A successful call to `POST /send` returns a `202` status code along with a `requestId` in the response body.
     * For single-recipient requests, the `requestId` is the derived message_id. For multiple recipients, Courier assigns a unique message_id to each derived message.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }
}
