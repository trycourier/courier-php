<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendMessageParams\Message;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new SendMessageParams); // set properties as needed
 * $client->send->message(...$params->toArray());
 * ```
 * Use the send API to send a message to one or more recipients.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->send->message(...$params->toArray());`
 *
 * @see Courier\Send->message
 *
 * @phpstan-type send_message_params = array{message: Message}
 */
final class SendMessageParams implements BaseModel
{
    /** @use SdkModel<send_message_params> */
    use SdkModel;
    use SdkParams;

    /**
     * The message property has the following primary top-level properties. They define the destination and content of the message.
     */
    #[Api]
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
     */
    public static function with(Message $message): self
    {
        $obj = new self;

        $obj->message = $message;

        return $obj;
    }

    /**
     * The message property has the following primary top-level properties. They define the destination and content of the message.
     */
    public function withMessage(Message $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }
}
