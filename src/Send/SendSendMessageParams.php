<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Message\ContentMessage;
use Courier\Send\Message\TemplateMessage;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new SendSendMessageParams); // set properties as needed
 * $client->send->sendMessage(...$params->toArray());
 * ```
 * Use the send API to send a message to one or more recipients.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->send->sendMessage(...$params->toArray());`
 *
 * @see Courier\Send->sendMessage
 *
 * @phpstan-type send_send_message_params = array{
 *   message: ContentMessage|TemplateMessage
 * }
 */
final class SendSendMessageParams implements BaseModel
{
    /** @use SdkModel<send_send_message_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Defines the message to be delivered.
     */
    #[Api]
    public ContentMessage|TemplateMessage $message;

    /**
     * `new SendSendMessageParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendSendMessageParams::with(message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendSendMessageParams)->withMessage(...)
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
    public static function with(ContentMessage|TemplateMessage $message): self
    {
        $obj = new self;

        $obj->message = $message;

        return $obj;
    }

    /**
     * Defines the message to be delivered.
     */
    public function withMessage(ContentMessage|TemplateMessage $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }
}
