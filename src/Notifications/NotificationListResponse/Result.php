<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationListResponse;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRouting;
use Courier\Notifications\NotificationListResponse\Result\Tags;

/**
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 * @phpstan-import-type TagsShape from \Courier\Notifications\NotificationListResponse\Result\Tags
 *
 * @phpstan-type ResultShape = array{
 *   id: string,
 *   createdAt: int,
 *   eventIDs: list<string>,
 *   note: string,
 *   routing: MessageRouting|MessageRoutingShape,
 *   topicID: string,
 *   updatedAt: int,
 *   tags?: null|Tags|TagsShape,
 *   title?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('created_at')]
    public int $createdAt;

    /**
     * Array of event IDs associated with this notification.
     *
     * @var list<string> $eventIDs
     */
    #[Required('event_ids', list: 'string')]
    public array $eventIDs;

    #[Required]
    public string $note;

    #[Required]
    public MessageRouting $routing;

    #[Required('topic_id')]
    public string $topicID;

    #[Required('updated_at')]
    public int $updatedAt;

    #[Optional(nullable: true)]
    public ?Tags $tags;

    #[Optional(nullable: true)]
    public ?string $title;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(
     *   id: ...,
     *   createdAt: ...,
     *   eventIDs: ...,
     *   note: ...,
     *   routing: ...,
     *   topicID: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withEventIDs(...)
     *   ->withNote(...)
     *   ->withRouting(...)
     *   ->withTopicID(...)
     *   ->withUpdatedAt(...)
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
     * @param list<string> $eventIDs
     * @param MessageRoutingShape $routing
     * @param TagsShape|null $tags
     */
    public static function with(
        string $id,
        int $createdAt,
        array $eventIDs,
        string $note,
        MessageRouting|array $routing,
        string $topicID,
        int $updatedAt,
        Tags|array|null $tags = null,
        ?string $title = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['eventIDs'] = $eventIDs;
        $self['note'] = $note;
        $self['routing'] = $routing;
        $self['topicID'] = $topicID;
        $self['updatedAt'] = $updatedAt;

        null !== $tags && $self['tags'] = $tags;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Array of event IDs associated with this notification.
     *
     * @param list<string> $eventIDs
     */
    public function withEventIDs(array $eventIDs): self
    {
        $self = clone $this;
        $self['eventIDs'] = $eventIDs;

        return $self;
    }

    public function withNote(string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }

    /**
     * @param MessageRoutingShape $routing
     */
    public function withRouting(MessageRouting|array $routing): self
    {
        $self = clone $this;
        $self['routing'] = $routing;

        return $self;
    }

    public function withTopicID(string $topicID): self
    {
        $self = clone $this;
        $self['topicID'] = $topicID;

        return $self;
    }

    public function withUpdatedAt(int $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * @param TagsShape|null $tags
     */
    public function withTags(Tags|array|null $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    public function withTitle(?string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
