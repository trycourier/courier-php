<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationListResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRouting;
use Courier\MessageRouting\Method;
use Courier\Notifications\NotificationListResponse\Result\Tags;
use Courier\Notifications\NotificationListResponse\Result\Tags\Data;

/**
 * @phpstan-type ResultShape = array{
 *   id: string,
 *   created_at: int,
 *   event_ids: list<string>,
 *   note: string,
 *   routing: MessageRouting,
 *   topic_id: string,
 *   updated_at: int,
 *   tags?: Tags|null,
 *   title?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    #[Api]
    public string $id;

    #[Api]
    public int $created_at;

    /**
     * Array of event IDs associated with this notification.
     *
     * @var list<string> $event_ids
     */
    #[Api(list: 'string')]
    public array $event_ids;

    #[Api]
    public string $note;

    #[Api]
    public MessageRouting $routing;

    #[Api]
    public string $topic_id;

    #[Api]
    public int $updated_at;

    #[Api(nullable: true, optional: true)]
    public ?Tags $tags;

    #[Api(nullable: true, optional: true)]
    public ?string $title;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(
     *   id: ...,
     *   created_at: ...,
     *   event_ids: ...,
     *   note: ...,
     *   routing: ...,
     *   topic_id: ...,
     *   updated_at: ...,
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
     * @param list<string> $event_ids
     * @param MessageRouting|array{
     *   channels: list<mixed>, method: value-of<Method>
     * } $routing
     * @param Tags|array{data: list<Data>}|null $tags
     */
    public static function with(
        string $id,
        int $created_at,
        array $event_ids,
        string $note,
        MessageRouting|array $routing,
        string $topic_id,
        int $updated_at,
        Tags|array|null $tags = null,
        ?string $title = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['created_at'] = $created_at;
        $obj['event_ids'] = $event_ids;
        $obj['note'] = $note;
        $obj['routing'] = $routing;
        $obj['topic_id'] = $topic_id;
        $obj['updated_at'] = $updated_at;

        null !== $tags && $obj['tags'] = $tags;
        null !== $title && $obj['title'] = $title;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withCreatedAt(int $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * Array of event IDs associated with this notification.
     *
     * @param list<string> $eventIDs
     */
    public function withEventIDs(array $eventIDs): self
    {
        $obj = clone $this;
        $obj['event_ids'] = $eventIDs;

        return $obj;
    }

    public function withNote(string $note): self
    {
        $obj = clone $this;
        $obj['note'] = $note;

        return $obj;
    }

    /**
     * @param MessageRouting|array{
     *   channels: list<mixed>, method: value-of<Method>
     * } $routing
     */
    public function withRouting(MessageRouting|array $routing): self
    {
        $obj = clone $this;
        $obj['routing'] = $routing;

        return $obj;
    }

    public function withTopicID(string $topicID): self
    {
        $obj = clone $this;
        $obj['topic_id'] = $topicID;

        return $obj;
    }

    public function withUpdatedAt(int $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

        return $obj;
    }

    /**
     * @param Tags|array{data: list<Data>}|null $tags
     */
    public function withTags(Tags|array|null $tags): self
    {
        $obj = clone $this;
        $obj['tags'] = $tags;

        return $obj;
    }

    public function withTitle(?string $title): self
    {
        $obj = clone $this;
        $obj['title'] = $title;

        return $obj;
    }
}
