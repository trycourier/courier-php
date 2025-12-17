<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendMessageParams\Message;

/**
 * Send a message to one or more recipients.
 *
 * @see Courier\Services\SendService::message()
 *
 * @phpstan-import-type MessageShape from \Courier\Send\SendMessageParams\Message
 *
 * @phpstan-type SendMessageParamsShape = array{message: MessageShape}
 */
final class SendMessageParams implements BaseModel
{
    /** @use SdkModel<SendMessageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The message property has the following primary top-level properties. They define the destination and content of the message.
     */
    #[Required]
    public Message $message;

    /**
     * `new SendMessageParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendMessageParams::with(message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendMessageParams)->withMessage(...)
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
     * @param MessageShape $message
     */
    public static function with(Message|array $message): self
    {
        $self = new self;

        $self['message'] = $message;

        return $self;
    }

    /**
     * The message property has the following primary top-level properties. They define the destination and content of the message.
     *
     * @param MessageShape $message
     */
    public function withMessage(Message|array $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
