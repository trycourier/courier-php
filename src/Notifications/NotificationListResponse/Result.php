<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationListResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationListResponse\Result\Tags;
use Courier\Send\MessageRouting;

/**
 * @phpstan-type result_alias = array{
 *   id: string,
 *   createdAt: int,
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
    /** @use SdkModel<result_alias> */
    use SdkModel;

    #[Api]
    public string $id;

    #[Api('created_at')]
    public int $createdAt;

    #[Api]
    public string $note;

    #[Api]
    public MessageRouting $routing;

    #[Api('topic_id')]
    public string $topicID;

    #[Api('updated_at')]
    public int $updatedAt;

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
     *   id: ..., createdAt: ..., note: ..., routing: ..., topicID: ..., updatedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withID(...)
     *   ->withCreatedAt(...)
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
     */
    public static function with(
        string $id,
        int $createdAt,
        string $note,
        MessageRouting $routing,
        string $topicID,
        int $updatedAt,
        ?Tags $tags = null,
        ?string $title = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->createdAt = $createdAt;
        $obj->note = $note;
        $obj->routing = $routing;
        $obj->topicID = $topicID;
        $obj->updatedAt = $updatedAt;

        null !== $tags && $obj->tags = $tags;
        null !== $title && $obj->title = $title;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withCreatedAt(int $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    public function withNote(string $note): self
    {
        $obj = clone $this;
        $obj->note = $note;

        return $obj;
    }

    public function withRouting(MessageRouting $routing): self
    {
        $obj = clone $this;
        $obj->routing = $routing;

        return $obj;
    }

    public function withTopicID(string $topicID): self
    {
        $obj = clone $this;
        $obj->topicID = $topicID;

        return $obj;
    }

    public function withUpdatedAt(int $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    public function withTags(?Tags $tags): self
    {
        $obj = clone $this;
        $obj->tags = $tags;

        return $obj;
    }

    public function withTitle(?string $title): self
    {
        $obj = clone $this;
        $obj->title = $title;

        return $obj;
    }
}
