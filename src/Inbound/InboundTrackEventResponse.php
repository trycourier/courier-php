<?php

declare(strict_types=1);

namespace Courier\Inbound;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type InboundTrackEventResponseShape = array{messageID: string}
 */
final class InboundTrackEventResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<InboundTrackEventResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * A successful call returns a `202` status code along with a `requestId` in the response body.
     */
    #[Api('messageId')]
    public string $messageID;

    /**
     * `new InboundTrackEventResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundTrackEventResponse::with(messageID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundTrackEventResponse)->withMessageID(...)
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
    public static function with(string $messageID): self
    {
        $obj = new self;

        $obj->messageID = $messageID;

        return $obj;
    }

    /**
     * A successful call returns a `202` status code along with a `requestId` in the response body.
     */
    public function withMessageID(string $messageID): self
    {
        $obj = clone $this;
        $obj->messageID = $messageID;

        return $obj;
    }
}
