<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;
use Courier\MessageContext;
use Courier\Recipient;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageParams\Message\Channel;
use Courier\Send\SendMessageParams\Message\Delay;
use Courier\Send\SendMessageParams\Message\Expiry;
use Courier\Send\SendMessageParams\Message\Metadata;
use Courier\Send\SendMessageParams\Message\Preferences;
use Courier\Send\SendMessageParams\Message\Provider;
use Courier\Send\SendMessageParams\Message\Routing;
use Courier\Send\SendMessageParams\Message\Timeout;
use Courier\UserRecipient;

/**
 * Send a message to one or more recipients.
 *
 * @see Courier\Services\SendService::message()
 *
 * @phpstan-type SendMessageParamsShape = array{
 *   message: Message|array{
 *     brandID?: string|null,
 *     channels?: array<string,Channel>|null,
 *     content?: null|ElementalContentSugar|ElementalContent,
 *     context?: MessageContext|null,
 *     data?: array<string,mixed>|null,
 *     delay?: Delay|null,
 *     expiry?: Expiry|null,
 *     metadata?: Metadata|null,
 *     preferences?: Preferences|null,
 *     providers?: array<string,Provider>|null,
 *     routing?: Routing|null,
 *     template?: string|null,
 *     timeout?: Timeout|null,
 *     to?: null|UserRecipient|list<Recipient>,
 *   },
 * }
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
     * @param Message|array{
     *   brandID?: string|null,
     *   channels?: array<string,Channel>|null,
     *   content?: ElementalContentSugar|ElementalContent|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   delay?: Delay|null,
     *   expiry?: Expiry|null,
     *   metadata?: Metadata|null,
     *   preferences?: Preferences|null,
     *   providers?: array<string,Provider>|null,
     *   routing?: Routing|null,
     *   template?: string|null,
     *   timeout?: Timeout|null,
     *   to?: UserRecipient|list<Recipient>|null,
     * } $message
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
     * @param Message|array{
     *   brandID?: string|null,
     *   channels?: array<string,Channel>|null,
     *   content?: ElementalContentSugar|ElementalContent|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   delay?: Delay|null,
     *   expiry?: Expiry|null,
     *   metadata?: Metadata|null,
     *   preferences?: Preferences|null,
     *   providers?: array<string,Provider>|null,
     *   routing?: Routing|null,
     *   template?: string|null,
     *   timeout?: Timeout|null,
     *   to?: UserRecipient|list<Recipient>|null,
     * } $message
     */
    public function withMessage(Message|array $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
