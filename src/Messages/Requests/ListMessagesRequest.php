<?php

namespace Courier\Messages\Requests;

use Courier\Core\Json\JsonSerializableType;

class ListMessagesRequest extends JsonSerializableType
{
    /**
     * @var ?bool $archived A boolean value that indicates whether archived messages should be included in the response.
     */
    public ?bool $archived;

    /**
     * @var ?string $cursor A unique identifier that allows for fetching the next set of messages.
     */
    public ?string $cursor;

    /**
     * @var ?string $event A unique identifier representing the event that was used to send the event.
     */
    public ?string $event;

    /**
     * @var ?string $list A unique identifier representing the list the message was sent to.
     */
    public ?string $list;

    /**
     * @var ?string $messageId A unique identifier representing the message_id returned from either /send or /send/list.
     */
    public ?string $messageId;

    /**
     * @var ?string $notification A unique identifier representing the notification that was used to send the event.
     */
    public ?string $notification;

    /**
     * @var ?array<string> $provider The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     */
    public ?array $provider;

    /**
     * @var ?string $recipient A unique identifier representing the recipient associated with the requested profile.
     */
    public ?string $recipient;

    /**
     * @var ?array<string> $status An indicator of the current status of the message. Allows multiple values to be set in query parameters.
     */
    public ?array $status;

    /**
     * @var ?array<string> $tag A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     */
    public ?array $tag;

    /**
     * @var ?string $tags A comma delimited list of 'tags'. Messages will be returned if they match any of the tags passed in.
     */
    public ?string $tags;

    /**
     * @var ?string $tenantId Messages sent with the context of a Tenant
     */
    public ?string $tenantId;

    /**
     * @var ?string $enqueuedAfter The enqueued datetime of a message to filter out messages received before.
     */
    public ?string $enqueuedAfter;

    /**
     * @var ?string $traceId The unique identifier used to trace the requests
     */
    public ?string $traceId;

    /**
     * @param array{
     *   archived?: ?bool,
     *   cursor?: ?string,
     *   event?: ?string,
     *   list?: ?string,
     *   messageId?: ?string,
     *   notification?: ?string,
     *   provider?: ?array<string>,
     *   recipient?: ?string,
     *   status?: ?array<string>,
     *   tag?: ?array<string>,
     *   tags?: ?string,
     *   tenantId?: ?string,
     *   enqueuedAfter?: ?string,
     *   traceId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->archived = $values['archived'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
        $this->event = $values['event'] ?? null;
        $this->list = $values['list'] ?? null;
        $this->messageId = $values['messageId'] ?? null;
        $this->notification = $values['notification'] ?? null;
        $this->provider = $values['provider'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->tag = $values['tag'] ?? null;
        $this->tags = $values['tags'] ?? null;
        $this->tenantId = $values['tenantId'] ?? null;
        $this->enqueuedAfter = $values['enqueuedAfter'] ?? null;
        $this->traceId = $values['traceId'] ?? null;
    }
}
