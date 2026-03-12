<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\MapOf;
use Courier\Messages\MessageDetails\Reason;
use Courier\Messages\MessageDetails\Status;

/**
 * @phpstan-type MessageGetResponseShape = array{
 *   id: string,
 *   enqueued: int,
 *   event: string,
 *   notification: string,
 *   recipient: string,
 *   status: Status|value-of<Status>,
 *   clicked?: int|null,
 *   delivered?: int|null,
 *   error?: string|null,
 *   opened?: int|null,
 *   reason?: null|Reason|value-of<Reason>,
 *   sent?: int|null,
 *   providers?: list<array<string,mixed>>|null,
 * }
 */
final class MessageGetResponse implements BaseModel
{
    /** @use SdkModel<MessageGetResponseShape> */
    use SdkModel;

    /**
     * A unique identifier associated with the message you wish to retrieve (results from a send).
     */
    #[Required]
    public string $id;

    /**
     * A UTC timestamp at which Courier received the message request. Stored as a millisecond representation of the Unix epoch.
     */
    #[Required]
    public int $enqueued;

    /**
     * A unique identifier associated with the event of the delivered message.
     */
    #[Required]
    public string $event;

    /**
     * A unique identifier associated with the notification of the delivered message.
     */
    #[Required]
    public string $notification;

    /**
     * A unique identifier associated with the recipient of the delivered message.
     */
    #[Required]
    public string $recipient;

    /**
     * The current status of the message.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A UTC timestamp at which the recipient clicked on a tracked link for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    #[Optional]
    public ?int $clicked;

    /**
     * A UTC timestamp at which the Integration provider delivered the message. Stored as a millisecond representation of the Unix epoch.
     */
    #[Optional]
    public ?int $delivered;

    /**
     * A message describing the error that occurred.
     */
    #[Optional(nullable: true)]
    public ?string $error;

    /**
     * A UTC timestamp at which the recipient opened a message for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    #[Optional]
    public ?int $opened;

    /**
     * The reason for the current status of the message.
     *
     * @var value-of<Reason>|null $reason
     */
    #[Optional(enum: Reason::class, nullable: true)]
    public ?string $reason;

    /**
     * A UTC timestamp at which Courier passed the message to the Integration provider. Stored as a millisecond representation of the Unix epoch.
     */
    #[Optional]
    public ?int $sent;

    /** @var list<array<string,mixed>>|null $providers */
    #[Optional(list: new MapOf('mixed'), nullable: true)]
    public ?array $providers;

    /**
     * `new MessageGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageGetResponse::with(
     *   id: ...,
     *   enqueued: ...,
     *   event: ...,
     *   notification: ...,
     *   recipient: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageGetResponse)
     *   ->withID(...)
     *   ->withEnqueued(...)
     *   ->withEvent(...)
     *   ->withNotification(...)
     *   ->withRecipient(...)
     *   ->withStatus(...)
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
     * @param Status|value-of<Status> $status
     * @param Reason|value-of<Reason>|null $reason
     * @param list<array<string,mixed>>|null $providers
     */
    public static function with(
        string $id,
        int $enqueued,
        string $event,
        string $notification,
        string $recipient,
        Status|string $status,
        ?int $clicked = null,
        ?int $delivered = null,
        ?string $error = null,
        ?int $opened = null,
        Reason|string|null $reason = null,
        ?int $sent = null,
        ?array $providers = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['enqueued'] = $enqueued;
        $self['event'] = $event;
        $self['notification'] = $notification;
        $self['recipient'] = $recipient;
        $self['status'] = $status;

        null !== $clicked && $self['clicked'] = $clicked;
        null !== $delivered && $self['delivered'] = $delivered;
        null !== $error && $self['error'] = $error;
        null !== $opened && $self['opened'] = $opened;
        null !== $reason && $self['reason'] = $reason;
        null !== $sent && $self['sent'] = $sent;
        null !== $providers && $self['providers'] = $providers;

        return $self;
    }

    /**
     * A unique identifier associated with the message you wish to retrieve (results from a send).
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * A UTC timestamp at which Courier received the message request. Stored as a millisecond representation of the Unix epoch.
     */
    public function withEnqueued(int $enqueued): self
    {
        $self = clone $this;
        $self['enqueued'] = $enqueued;

        return $self;
    }

    /**
     * A unique identifier associated with the event of the delivered message.
     */
    public function withEvent(string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * A unique identifier associated with the notification of the delivered message.
     */
    public function withNotification(string $notification): self
    {
        $self = clone $this;
        $self['notification'] = $notification;

        return $self;
    }

    /**
     * A unique identifier associated with the recipient of the delivered message.
     */
    public function withRecipient(string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    /**
     * The current status of the message.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A UTC timestamp at which the recipient clicked on a tracked link for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    public function withClicked(int $clicked): self
    {
        $self = clone $this;
        $self['clicked'] = $clicked;

        return $self;
    }

    /**
     * A UTC timestamp at which the Integration provider delivered the message. Stored as a millisecond representation of the Unix epoch.
     */
    public function withDelivered(int $delivered): self
    {
        $self = clone $this;
        $self['delivered'] = $delivered;

        return $self;
    }

    /**
     * A message describing the error that occurred.
     */
    public function withError(?string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * A UTC timestamp at which the recipient opened a message for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    public function withOpened(int $opened): self
    {
        $self = clone $this;
        $self['opened'] = $opened;

        return $self;
    }

    /**
     * The reason for the current status of the message.
     *
     * @param Reason|value-of<Reason>|null $reason
     */
    public function withReason(Reason|string|null $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * A UTC timestamp at which Courier passed the message to the Integration provider. Stored as a millisecond representation of the Unix epoch.
     */
    public function withSent(int $sent): self
    {
        $self = clone $this;
        $self['sent'] = $sent;

        return $self;
    }

    /**
     * @param list<array<string,mixed>>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $self = clone $this;
        $self['providers'] = $providers;

        return $self;
    }
}
