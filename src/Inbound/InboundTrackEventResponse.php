<?php

declare(strict_types=1);

namespace Courier\Inbound;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type InboundTrackEventResponseShape = array{messageId: string}
 */
final class InboundTrackEventResponse implements BaseModel
{
    /** @use SdkModel<InboundTrackEventResponseShape> */
    use SdkModel;

    /**
     * A successful call returns a `202` status code along with a `requestId` in the response body.
     */
    #[Required]
    public string $messageId;

    /**
     * `new InboundTrackEventResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundTrackEventResponse::with(messageId: ...)
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
    public static function with(string $messageId): self
    {
        $obj = new self;

        $obj['messageId'] = $messageId;

        return $obj;
    }

    /**
     * A successful call returns a `202` status code along with a `requestId` in the response body.
     */
    public function withMessageID(string $messageID): self
    {
        $obj = clone $this;
        $obj['messageId'] = $messageID;

        return $obj;
    }
}
