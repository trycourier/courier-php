<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationListResponse;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRouting;
use Courier\MessageRouting\Method;
use Courier\Notifications\NotificationListResponse\Result\Tags;
use Courier\Notifications\NotificationListResponse\Result\Tags\Data;

/**
 * @phpstan-type ResultShape = array{
 *   id: string,
 *   createdAt: int,
 *   eventIDs: list<string>,
 *   note: string,
 *   routing: MessageRouting,
 *   topicID: string,
 *   updatedAt: int,
 *   tags?: Tags|null,
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
     * @param MessageRouting|array{
     *   channels: list<mixed>, method: value-of<Method>
     * } $routing
     * @param Tags|array{data: list<Data>}|null $tags
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
        $obj = new self;

        $obj['id'] = $id;
        $obj['createdAt'] = $createdAt;
        $obj['eventIDs'] = $eventIDs;
        $obj['note'] = $note;
        $obj['routing'] = $routing;
        $obj['topicID'] = $topicID;
        $obj['updatedAt'] = $updatedAt;

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
        $obj['createdAt'] = $createdAt;

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
        $obj['eventIDs'] = $eventIDs;

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
        $obj['topicID'] = $topicID;

        return $obj;
    }

    public function withUpdatedAt(int $updatedAt): self
    {
        $obj = clone $this;
        $obj['updatedAt'] = $updatedAt;

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
