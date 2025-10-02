<?php

namespace Courier\Messages\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class MessageDetails extends JsonSerializableType
{
    /**
     * @var string $id A unique identifier associated with the message you wish to retrieve (results from a send).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var value-of<MessageStatus> $status The current status of the message.
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var int $enqueued A UTC timestamp at which Courier received the message request. Stored as a millisecond representation of the Unix epoch.
     */
    #[JsonProperty('enqueued')]
    public int $enqueued;

    /**
     * @var int $sent A UTC timestamp at which Courier passed the message to the Integration provider. Stored as a millisecond representation of the Unix epoch.
     */
    #[JsonProperty('sent')]
    public int $sent;

    /**
     * @var int $delivered A UTC timestamp at which the Integration provider delivered the message. Stored as a millisecond representation of the Unix epoch.
     */
    #[JsonProperty('delivered')]
    public int $delivered;

    /**
     * @var int $opened A UTC timestamp at which the recipient opened a message for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    #[JsonProperty('opened')]
    public int $opened;

    /**
     * @var int $clicked A UTC timestamp at which the recipient clicked on a tracked link for the first time. Stored as a millisecond representation of the Unix epoch.
     */
    #[JsonProperty('clicked')]
    public int $clicked;

    /**
     * @var string $recipient A unique identifier associated with the recipient of the delivered message.
     */
    #[JsonProperty('recipient')]
    public string $recipient;

    /**
     * @var string $event A unique identifier associated with the event of the delivered message.
     */
    #[JsonProperty('event')]
    public string $event;

    /**
     * @var string $notification A unique identifier associated with the notification of the delivered message.
     */
    #[JsonProperty('notification')]
    public string $notification;

    /**
     * @var ?string $error A message describing the error that occurred.
     */
    #[JsonProperty('error')]
    public ?string $error;

    /**
     * @var ?value-of<Reason> $reason The reason for the current status of the message.
     */
    #[JsonProperty('reason')]
    public ?string $reason;

    /**
     * @param array{
     *   id: string,
     *   status: value-of<MessageStatus>,
     *   enqueued: int,
     *   sent: int,
     *   delivered: int,
     *   opened: int,
     *   clicked: int,
     *   recipient: string,
     *   event: string,
     *   notification: string,
     *   error?: ?string,
     *   reason?: ?value-of<Reason>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->status = $values['status'];
        $this->enqueued = $values['enqueued'];
        $this->sent = $values['sent'];
        $this->delivered = $values['delivered'];
        $this->opened = $values['opened'];
        $this->clicked = $values['clicked'];
        $this->recipient = $values['recipient'];
        $this->event = $values['event'];
        $this->notification = $values['notification'];
        $this->error = $values['error'] ?? null;
        $this->reason = $values['reason'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
