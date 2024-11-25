<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Notification extends JsonSerializableType
{
    /**
     * @var int $createdAt
     */
    #[JsonProperty('created_at')]
    public int $createdAt;

    /**
     * @var int $updatedAt
     */
    #[JsonProperty('updated_at')]
    public int $updatedAt;

    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var MessageRouting $routing
     */
    #[JsonProperty('routing')]
    public MessageRouting $routing;

    /**
     * @var ?NotificationTag $tags
     */
    #[JsonProperty('tags')]
    public ?NotificationTag $tags;

    /**
     * @var ?string $title
     */
    #[JsonProperty('title')]
    public ?string $title;

    /**
     * @var string $topicId
     */
    #[JsonProperty('topic_id')]
    public string $topicId;

    /**
     * @var string $note
     */
    #[JsonProperty('note')]
    public string $note;

    /**
     * @param array{
     *   createdAt: int,
     *   updatedAt: int,
     *   id: string,
     *   routing: MessageRouting,
     *   tags?: ?NotificationTag,
     *   title?: ?string,
     *   topicId: string,
     *   note: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->id = $values['id'];
        $this->routing = $values['routing'];
        $this->tags = $values['tags'] ?? null;
        $this->title = $values['title'] ?? null;
        $this->topicId = $values['topicId'];
        $this->note = $values['note'];
    }
}
