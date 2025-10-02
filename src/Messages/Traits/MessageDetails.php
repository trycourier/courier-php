<?php

namespace Courier\Messages\Traits;

use Courier\Messages\Types\MessageStatus;
use Courier\Messages\Types\Reason;
use Courier\Core\Json\JsonProperty;

/**
 * @property string $id
 * @property value-of<MessageStatus> $status
 * @property int $enqueued
 * @property int $sent
 * @property int $delivered
 * @property int $opened
 * @property int $clicked
 * @property string $recipient
 * @property string $event
 * @property string $notification
 * @property ?string $error
 * @property ?value-of<Reason> $reason
 */
trait MessageDetails
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
}
