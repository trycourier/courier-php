<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Core\Conversion\MapOf;
use Courier\Messages\MessageDetails\Reason;
use Courier\Messages\MessageDetails\Status;

/**
 * @phpstan-type MessageGetResponseShape = array{
 *   id: string,
 *   clicked: int,
 *   delivered: int,
 *   enqueued: int,
 *   event: string,
 *   notification: string,
 *   opened: int,
 *   recipient: string,
 *   sent: int,
 *   status: value-of<Status>,
 *   error?: string|null,
 *   reason?: value-of<Reason>|null,
 *   providers?: list<array<string, mixed>>|null,
 * }
 */
final class MessageGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<MessageGetResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * A unique identifier associated with the message you wish to retrieve (results from a send).
     */
    #[Api]
    public string $id;

    /**
     * A UTC timestamp at which the recipient clicked on a tracked link for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    #[Api]
    public int $clicked;

    /**
     * A UTC timestamp at which the Integration provider delivered the message. Stored as a millisecond representation of the Unix epoch.
     */
    #[Api]
    public int $delivered;

    /**
     * A UTC timestamp at which Courier received the message request. Stored as a millisecond representation of the Unix epoch.
     */
    #[Api]
    public int $enqueued;

    /**
     * A unique identifier associated with the event of the delivered message.
     */
    #[Api]
    public string $event;

    /**
     * A unique identifier associated with the notification of the delivered message.
     */
    #[Api]
    public string $notification;

    /**
     * A UTC timestamp at which the recipient opened a message for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    #[Api]
    public int $opened;

    /**
     * A unique identifier associated with the recipient of the delivered message.
     */
    #[Api]
    public string $recipient;

    /**
     * A UTC timestamp at which Courier passed the message to the Integration provider. Stored as a millisecond representation of the Unix epoch.
     */
    #[Api]
    public int $sent;

    /**
     * The current status of the message.
     *
     * @var value-of<Status> $status
     */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * A message describing the error that occurred.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $error;

    /**
     * The reason for the current status of the message.
     *
     * @var value-of<Reason>|null $reason
     */
    #[Api(enum: Reason::class, nullable: true, optional: true)]
    public ?string $reason;

    /** @var list<array<string, mixed>>|null $providers */
    #[Api(list: new MapOf('mixed'), nullable: true, optional: true)]
    public ?array $providers;

    /**
     * `new MessageGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageGetResponse::with(
     *   id: ...,
     *   clicked: ...,
     *   delivered: ...,
     *   enqueued: ...,
     *   event: ...,
     *   notification: ...,
     *   opened: ...,
     *   recipient: ...,
     *   sent: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageGetResponse)
     *   ->withID(...)
     *   ->withClicked(...)
     *   ->withDelivered(...)
     *   ->withEnqueued(...)
     *   ->withEvent(...)
     *   ->withNotification(...)
     *   ->withOpened(...)
     *   ->withRecipient(...)
     *   ->withSent(...)
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
     * @param list<array<string, mixed>>|null $providers
     */
    public static function with(
        string $id,
        int $clicked,
        int $delivered,
        int $enqueued,
        string $event,
        string $notification,
        int $opened,
        string $recipient,
        int $sent,
        Status|string $status,
        ?string $error = null,
        Reason|string|null $reason = null,
        ?array $providers = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->clicked = $clicked;
        $obj->delivered = $delivered;
        $obj->enqueued = $enqueued;
        $obj->event = $event;
        $obj->notification = $notification;
        $obj->opened = $opened;
        $obj->recipient = $recipient;
        $obj->sent = $sent;
        $obj['status'] = $status;

        null !== $error && $obj->error = $error;
        null !== $reason && $obj['reason'] = $reason;
        null !== $providers && $obj->providers = $providers;

        return $obj;
    }

    /**
     * A unique identifier associated with the message you wish to retrieve (results from a send).
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * A UTC timestamp at which the recipient clicked on a tracked link for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    public function withClicked(int $clicked): self
    {
        $obj = clone $this;
        $obj->clicked = $clicked;

        return $obj;
    }

    /**
     * A UTC timestamp at which the Integration provider delivered the message. Stored as a millisecond representation of the Unix epoch.
     */
    public function withDelivered(int $delivered): self
    {
        $obj = clone $this;
        $obj->delivered = $delivered;

        return $obj;
    }

    /**
     * A UTC timestamp at which Courier received the message request. Stored as a millisecond representation of the Unix epoch.
     */
    public function withEnqueued(int $enqueued): self
    {
        $obj = clone $this;
        $obj->enqueued = $enqueued;

        return $obj;
    }

    /**
     * A unique identifier associated with the event of the delivered message.
     */
    public function withEvent(string $event): self
    {
        $obj = clone $this;
        $obj->event = $event;

        return $obj;
    }

    /**
     * A unique identifier associated with the notification of the delivered message.
     */
    public function withNotification(string $notification): self
    {
        $obj = clone $this;
        $obj->notification = $notification;

        return $obj;
    }

    /**
     * A UTC timestamp at which the recipient opened a message for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    public function withOpened(int $opened): self
    {
        $obj = clone $this;
        $obj->opened = $opened;

        return $obj;
    }

    /**
     * A unique identifier associated with the recipient of the delivered message.
     */
    public function withRecipient(string $recipient): self
    {
        $obj = clone $this;
        $obj->recipient = $recipient;

        return $obj;
    }

    /**
     * A UTC timestamp at which Courier passed the message to the Integration provider. Stored as a millisecond representation of the Unix epoch.
     */
    public function withSent(int $sent): self
    {
        $obj = clone $this;
        $obj->sent = $sent;

        return $obj;
    }

    /**
     * The current status of the message.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * A message describing the error that occurred.
     */
    public function withError(?string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }

    /**
     * The reason for the current status of the message.
     *
     * @param Reason|value-of<Reason>|null $reason
     */
    public function withReason(Reason|string|null $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

        return $obj;
    }

    /**
     * @param list<array<string, mixed>>|null $providers
     */
    public function withProviders(?array $providers): self
    {
        $obj = clone $this;
        $obj->providers = $providers;

        return $obj;
    }
}
