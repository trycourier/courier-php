<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendMessageParams\Message;

/**
 * Sends a message to one or more recipients and returns a requestId. Courier routes it to email, SMS, push, chat, or in-app based on your rules. Use the returned requestId to look up delivery status via the Messages API.
 *
 * @see Courier\Services\SendService::message()
 *
 * @phpstan-import-type MessageShape from \Courier\Send\SendMessageParams\Message
 *
 * @phpstan-type SendMessageParamsShape = array{
 *   message: Message|MessageShape,
 *   idempotencyKey?: string|null,
 *   xIdempotencyExpiration?: string|null,
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

    #[Optional]
    public ?string $idempotencyKey;

    #[Optional]
    public ?string $xIdempotencyExpiration;

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
     * @param Message|MessageShape $message
     */
    public static function with(
        Message|array $message,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
    ): self {
        $self = new self;

        $self['message'] = $message;

        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $xIdempotencyExpiration && $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

        return $self;
    }

    /**
     * The message property has the following primary top-level properties. They define the destination and content of the message.
     *
     * @param Message|MessageShape $message
     */
    public function withMessage(Message|array $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    public function withXIdempotencyExpiration(
        string $xIdempotencyExpiration
    ): self {
        $self = clone $this;
        $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

        return $self;
    }
}
