<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\ListOf;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new MessageListParams); // set properties as needed
 * $client->messages->list(...$params->toArray());
 * ```
 * Fetch the statuses of messages you've previously sent.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->messages->list(...$params->toArray());`
 *
 * @see Courier\Messages->list
 *
 * @phpstan-type message_list_params = array{
 *   archived?: bool|null,
 *   cursor?: string|null,
 *   enqueuedAfter?: string|null,
 *   event?: string|null,
 *   list?: string|null,
 *   messageID?: string|null,
 *   notification?: string|null,
 *   provider?: list<string>,
 *   recipient?: string|null,
 *   status?: list<string>,
 *   tag?: list<string>,
 *   tags?: string|null,
 *   tenantID?: string|null,
 *   traceID?: string|null,
 * }
 */
final class MessageListParams implements BaseModel
{
    /** @use SdkModel<message_list_params> */
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
    public ?string $enqueuedAfter;

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
    public ?string $messageID;

    /**
     * A unique identifier representing the notification that was used to send the event.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $notification;

    /**
     * The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     *
     * @var list<string>|null $provider
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
     * @var list<string>|null $status
     */
    #[Api(type: new ListOf('string', nullable: true), optional: true)]
    public ?array $status;

    /**
     * A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     *
     * @var list<string>|null $tag
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
    public ?string $tenantID;

    /**
     * The unique identifier used to trace the requests.
     */
    #[Api(nullable: true, optional: true)]
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
     * @param list<string> $provider
     * @param list<string> $status
     * @param list<string> $tag
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
        $obj = new self;

        null !== $archived && $obj->archived = $archived;
        null !== $cursor && $obj->cursor = $cursor;
        null !== $enqueuedAfter && $obj->enqueuedAfter = $enqueuedAfter;
        null !== $event && $obj->event = $event;
        null !== $list && $obj->list = $list;
        null !== $messageID && $obj->messageID = $messageID;
        null !== $notification && $obj->notification = $notification;
        null !== $provider && $obj->provider = $provider;
        null !== $recipient && $obj->recipient = $recipient;
        null !== $status && $obj->status = $status;
        null !== $tag && $obj->tag = $tag;
        null !== $tags && $obj->tags = $tags;
        null !== $tenantID && $obj->tenantID = $tenantID;
        null !== $traceID && $obj->traceID = $traceID;

        return $obj;
    }

    /**
     * A boolean value that indicates whether archived messages should be included in the response.
     */
    public function withArchived(?bool $archived): self
    {
        $obj = clone $this;
        $obj->archived = $archived;

        return $obj;
    }

    /**
     * A unique identifier that allows for fetching the next set of messages.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * The enqueued datetime of a message to filter out messages received before.
     */
    public function withEnqueuedAfter(?string $enqueuedAfter): self
    {
        $obj = clone $this;
        $obj->enqueuedAfter = $enqueuedAfter;

        return $obj;
    }

    /**
     * A unique identifier representing the event that was used to send the event.
     */
    public function withEvent(?string $event): self
    {
        $obj = clone $this;
        $obj->event = $event;

        return $obj;
    }

    /**
     * A unique identifier representing the list the message was sent to.
     */
    public function withList(?string $list): self
    {
        $obj = clone $this;
        $obj->list = $list;

        return $obj;
    }

    /**
     * A unique identifier representing the message_id returned from either /send or /send/list.
     */
    public function withMessageID(?string $messageID): self
    {
        $obj = clone $this;
        $obj->messageID = $messageID;

        return $obj;
    }

    /**
     * A unique identifier representing the notification that was used to send the event.
     */
    public function withNotification(?string $notification): self
    {
        $obj = clone $this;
        $obj->notification = $notification;

        return $obj;
    }

    /**
     * The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     *
     * @param list<string> $provider
     */
    public function withProvider(array $provider): self
    {
        $obj = clone $this;
        $obj->provider = $provider;

        return $obj;
    }

    /**
     * A unique identifier representing the recipient associated with the requested profile.
     */
    public function withRecipient(?string $recipient): self
    {
        $obj = clone $this;
        $obj->recipient = $recipient;

        return $obj;
    }

    /**
     * An indicator of the current status of the message. Allows multiple values to be set in query parameters.
     *
     * @param list<string> $status
     */
    public function withStatus(array $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     *
     * @param list<string> $tag
     */
    public function withTag(array $tag): self
    {
        $obj = clone $this;
        $obj->tag = $tag;

        return $obj;
    }

    /**
     * A comma delimited list of 'tags'. Messages will be returned if they match any of the tags passed in.
     */
    public function withTags(?string $tags): self
    {
        $obj = clone $this;
        $obj->tags = $tags;

        return $obj;
    }

    /**
     * Messages sent with the context of a Tenant.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }

    /**
     * The unique identifier used to trace the requests.
     */
    public function withTraceID(?string $traceID): self
    {
        $obj = clone $this;
        $obj->traceID = $traceID;

        return $obj;
    }
}
