<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type MessageResendResponseShape = array{messageID: string}
 */
final class MessageResendResponse implements BaseModel
{
    /** @use SdkModel<MessageResendResponseShape> */
    use SdkModel;

    /**
     * The new message id for the resent message. It is distinct from the id of the original message that was resent.
     */
    #[Required('messageId')]
    public string $messageID;

    /**
     * `new MessageResendResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageResendResponse::with(messageID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageResendResponse)->withMessageID(...)
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
        $self = new self;

        $self['messageID'] = $messageID;

        return $self;
    }

    /**
     * The new message id for the resent message. It is distinct from the id of the original message that was resent.
     */
    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }
}
