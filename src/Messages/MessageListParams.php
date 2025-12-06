<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Api;
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
 *   enqueued_after?: string|null,
 *   event?: string|null,
 *   list?: string|null,
 *   messageId?: string|null,
 *   notification?: string|null,
 *   provider?: list<string|null>,
 *   recipient?: string|null,
 *   status?: list<string|null>,
 *   tag?: list<string|null>,
 *   tags?: string|null,
 *   tenant_id?: string|null,
 *   traceId?: string|null,
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
    #[Api(nullable: true, optional: true)]
    public ?bool $archived;

    /**
     * A unique identifier that allows for fetching the next set of messages.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $cursor;

    /**
     * The enqueued datetime of a message to filter out messages received before.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $enqueued_after;

    /**
     * A unique identifier representing the event that was used to send the event.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $event;

    /**
     * A unique identifier representing the list the message was sent to.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $list;

    /**
     * A unique identifier representing the message_id returned from either /send or /send/list.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $messageId;

    /**
     * A unique identifier representing the notification that was used to send the event.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $notification;

    /**
     * The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     *
     * @var list<string|null>|null $provider
     */
    #[Api(type: new ListOf('string', nullable: true), optional: true)]
    public ?array $provider;

    /**
     * A unique identifier representing the recipient associated with the requested profile.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $recipient;

    /**
     * An indicator of the current status of the message. Allows multiple values to be set in query parameters.
     *
     * @var list<string|null>|null $status
     */
    #[Api(type: new ListOf('string', nullable: true), optional: true)]
    public ?array $status;

    /**
     * A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     *
     * @var list<string|null>|null $tag
     */
    #[Api(type: new ListOf('string', nullable: true), optional: true)]
    public ?array $tag;

    /**
     * A comma delimited list of 'tags'. Messages will be returned if they match any of the tags passed in.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tags;

    /**
     * Messages sent with the context of a Tenant.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tenant_id;

    /**
     * The unique identifier used to trace the requests.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $traceId;

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
        ?string $enqueued_after = null,
        ?string $event = null,
        ?string $list = null,
        ?string $messageId = null,
        ?string $notification = null,
        ?array $provider = null,
        ?string $recipient = null,
        ?array $status = null,
        ?array $tag = null,
        ?string $tags = null,
        ?string $tenant_id = null,
        ?string $traceId = null,
    ): self {
        $obj = new self;

        null !== $archived && $obj['archived'] = $archived;
        null !== $cursor && $obj['cursor'] = $cursor;
        null !== $enqueued_after && $obj['enqueued_after'] = $enqueued_after;
        null !== $event && $obj['event'] = $event;
        null !== $list && $obj['list'] = $list;
        null !== $messageId && $obj['messageId'] = $messageId;
        null !== $notification && $obj['notification'] = $notification;
        null !== $provider && $obj['provider'] = $provider;
        null !== $recipient && $obj['recipient'] = $recipient;
        null !== $status && $obj['status'] = $status;
        null !== $tag && $obj['tag'] = $tag;
        null !== $tags && $obj['tags'] = $tags;
        null !== $tenant_id && $obj['tenant_id'] = $tenant_id;
        null !== $traceId && $obj['traceId'] = $traceId;

        return $obj;
    }

    /**
     * A boolean value that indicates whether archived messages should be included in the response.
     */
    public function withArchived(?bool $archived): self
    {
        $obj = clone $this;
        $obj['archived'] = $archived;

        return $obj;
    }

    /**
     * A unique identifier that allows for fetching the next set of messages.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj['cursor'] = $cursor;

        return $obj;
    }

    /**
     * The enqueued datetime of a message to filter out messages received before.
     */
    public function withEnqueuedAfter(?string $enqueuedAfter): self
    {
        $obj = clone $this;
        $obj['enqueued_after'] = $enqueuedAfter;

        return $obj;
    }

    /**
     * A unique identifier representing the event that was used to send the event.
     */
    public function withEvent(?string $event): self
    {
        $obj = clone $this;
        $obj['event'] = $event;

        return $obj;
    }

    /**
     * A unique identifier representing the list the message was sent to.
     */
    public function withList(?string $list): self
    {
        $obj = clone $this;
        $obj['list'] = $list;

        return $obj;
    }

    /**
     * A unique identifier representing the message_id returned from either /send or /send/list.
     */
    public function withMessageID(?string $messageID): self
    {
        $obj = clone $this;
        $obj['messageId'] = $messageID;

        return $obj;
    }

    /**
     * A unique identifier representing the notification that was used to send the event.
     */
    public function withNotification(?string $notification): self
    {
        $obj = clone $this;
        $obj['notification'] = $notification;

        return $obj;
    }

    /**
     * The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     *
     * @param list<string|null> $provider
     */
    public function withProvider(array $provider): self
    {
        $obj = clone $this;
        $obj['provider'] = $provider;

        return $obj;
    }

    /**
     * A unique identifier representing the recipient associated with the requested profile.
     */
    public function withRecipient(?string $recipient): self
    {
        $obj = clone $this;
        $obj['recipient'] = $recipient;

        return $obj;
    }

    /**
     * An indicator of the current status of the message. Allows multiple values to be set in query parameters.
     *
     * @param list<string|null> $status
     */
    public function withStatus(array $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     *
     * @param list<string|null> $tag
     */
    public function withTag(array $tag): self
    {
        $obj = clone $this;
        $obj['tag'] = $tag;

        return $obj;
    }

    /**
     * A comma delimited list of 'tags'. Messages will be returned if they match any of the tags passed in.
     */
    public function withTags(?string $tags): self
    {
        $obj = clone $this;
        $obj['tags'] = $tags;

        return $obj;
    }

    /**
     * Messages sent with the context of a Tenant.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj['tenant_id'] = $tenantID;

        return $obj;
    }

    /**
     * The unique identifier used to trace the requests.
     */
    public function withTraceID(?string $traceID): self
    {
        $obj = clone $this;
        $obj['traceId'] = $traceID;

        return $obj;
    }
}
