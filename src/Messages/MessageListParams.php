<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\ListOf;

/**
 * Fetch the statuses of messages you've previously sent.
 *
 * @see Courier\Services\MessagesService::list()
 *
 * @phpstan-type MessageListParamsShape = array{
 *   archived?: bool|null,
 *   cursor?: string|null,
 *   enqueuedAfter?: string|null,
 *   event?: string|null,
 *   list?: string|null,
 *   messageID?: string|null,
 *   notification?: string|null,
 *   provider?: list<string|null>|null,
 *   recipient?: string|null,
 *   status?: list<string|null>|null,
 *   tag?: list<string|null>|null,
 *   tags?: string|null,
 *   tenantID?: string|null,
 *   traceID?: string|null,
 * }
 */
final class MessageListParams implements BaseModel
{
    /** @use SdkModel<MessageListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A boolean value that indicates whether archived messages should be included in the response.
     */
    #[Optional(nullable: true)]
    public ?bool $archived;

    /**
     * A unique identifier that allows for fetching the next set of messages.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * The enqueued datetime of a message to filter out messages received before.
     */
    #[Optional(nullable: true)]
    public ?string $enqueuedAfter;

    /**
     * A unique identifier representing the event that was used to send the event.
     */
    #[Optional(nullable: true)]
    public ?string $event;

    /**
     * A unique identifier representing the list the message was sent to.
     */
    #[Optional(nullable: true)]
    public ?string $list;

    /**
     * A unique identifier representing the message_id returned from either /send or /send/list.
     */
    #[Optional(nullable: true)]
    public ?string $messageID;

    /**
     * A unique identifier representing the notification that was used to send the event.
     */
    #[Optional(nullable: true)]
    public ?string $notification;

    /**
     * The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     *
     * @var list<string|null>|null $provider
     */
    #[Optional(type: new ListOf('string', nullable: true))]
    public ?array $provider;

    /**
     * A unique identifier representing the recipient associated with the requested profile.
     */
    #[Optional(nullable: true)]
    public ?string $recipient;

    /**
     * An indicator of the current status of the message. Allows multiple values to be set in query parameters.
     *
     * @var list<string|null>|null $status
     */
    #[Optional(type: new ListOf('string', nullable: true))]
    public ?array $status;

    /**
     * A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     *
     * @var list<string|null>|null $tag
     */
    #[Optional(type: new ListOf('string', nullable: true))]
    public ?array $tag;

    /**
     * A comma delimited list of 'tags'. Messages will be returned if they match any of the tags passed in.
     */
    #[Optional(nullable: true)]
    public ?string $tags;

    /**
     * Messages sent with the context of a Tenant.
     */
    #[Optional(nullable: true)]
    public ?string $tenantID;

    /**
     * The unique identifier used to trace the requests.
     */
    #[Optional(nullable: true)]
    public ?string $traceID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string|null> $provider
     * @param list<string|null> $status
     * @param list<string|null> $tag
     */
    public static function with(
        ?bool $archived = null,
        ?string $cursor = null,
        ?string $enqueuedAfter = null,
        ?string $event = null,
        ?string $list = null,
        ?string $messageID = null,
        ?string $notification = null,
        ?array $provider = null,
        ?string $recipient = null,
        ?array $status = null,
        ?array $tag = null,
        ?string $tags = null,
        ?string $tenantID = null,
        ?string $traceID = null,
    ): self {
        $self = new self;

        null !== $archived && $self['archived'] = $archived;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $enqueuedAfter && $self['enqueuedAfter'] = $enqueuedAfter;
        null !== $event && $self['event'] = $event;
        null !== $list && $self['list'] = $list;
        null !== $messageID && $self['messageID'] = $messageID;
        null !== $notification && $self['notification'] = $notification;
        null !== $provider && $self['provider'] = $provider;
        null !== $recipient && $self['recipient'] = $recipient;
        null !== $status && $self['status'] = $status;
        null !== $tag && $self['tag'] = $tag;
        null !== $tags && $self['tags'] = $tags;
        null !== $tenantID && $self['tenantID'] = $tenantID;
        null !== $traceID && $self['traceID'] = $traceID;

        return $self;
    }

    /**
     * A boolean value that indicates whether archived messages should be included in the response.
     */
    public function withArchived(?bool $archived): self
    {
        $self = clone $this;
        $self['archived'] = $archived;

        return $self;
    }

    /**
     * A unique identifier that allows for fetching the next set of messages.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * The enqueued datetime of a message to filter out messages received before.
     */
    public function withEnqueuedAfter(?string $enqueuedAfter): self
    {
        $self = clone $this;
        $self['enqueuedAfter'] = $enqueuedAfter;

        return $self;
    }

    /**
     * A unique identifier representing the event that was used to send the event.
     */
    public function withEvent(?string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * A unique identifier representing the list the message was sent to.
     */
    public function withList(?string $list): self
    {
        $self = clone $this;
        $self['list'] = $list;

        return $self;
    }

    /**
     * A unique identifier representing the message_id returned from either /send or /send/list.
     */
    public function withMessageID(?string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }

    /**
     * A unique identifier representing the notification that was used to send the event.
     */
    public function withNotification(?string $notification): self
    {
        $self = clone $this;
        $self['notification'] = $notification;

        return $self;
    }

    /**
     * The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     *
     * @param list<string|null> $provider
     */
    public function withProvider(array $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * A unique identifier representing the recipient associated with the requested profile.
     */
    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    /**
     * An indicator of the current status of the message. Allows multiple values to be set in query parameters.
     *
     * @param list<string|null> $status
     */
    public function withStatus(array $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     *
     * @param list<string|null> $tag
     */
    public function withTag(array $tag): self
    {
        $self = clone $this;
        $self['tag'] = $tag;

        return $self;
    }

    /**
     * A comma delimited list of 'tags'. Messages will be returned if they match any of the tags passed in.
     */
    public function withTags(?string $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Messages sent with the context of a Tenant.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * The unique identifier used to trace the requests.
     */
    public function withTraceID(?string $traceID): self
    {
        $self = clone $this;
        $self['traceID'] = $traceID;

        return $self;
    }
}
