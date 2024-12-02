<?php

namespace Courier\Templates\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class NotificationTemplates extends JsonSerializableType
{
    /**
     * @var int $createdAt A UTC timestamp at which notification was created. This is stored as a millisecond representation of the Unix epoch (the time passed since January 1, 1970).
     */
    #[JsonProperty('created_at')]
    public int $createdAt;

    /**
     * @var string $id A unique identifier associated with the notification.
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var RoutingStrategy $routing Routing strategy used by this notification.
     */
    #[JsonProperty('routing')]
    public RoutingStrategy $routing;

    /**
     * @var array<Tag> $tags A list of tags attached to the notification.
     */
    #[JsonProperty('tags'), ArrayType([Tag::class])]
    public array $tags;

    /**
     * @var string $title The title of the notification.
     */
    #[JsonProperty('title')]
    public string $title;

    /**
     * @var int $updatedAt A UTC timestamp at which notification was updated. This is stored as a millisecond representation of the Unix epoch (the time passed since January 1, 1970).
     */
    #[JsonProperty('updated_at')]
    public int $updatedAt;

    /**
     * @param array{
     *   createdAt: int,
     *   id: string,
     *   routing: RoutingStrategy,
     *   tags: array<Tag>,
     *   title: string,
     *   updatedAt: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->createdAt = $values['createdAt'];
        $this->id = $values['id'];
        $this->routing = $values['routing'];
        $this->tags = $values['tags'];
        $this->title = $values['title'];
        $this->updatedAt = $values['updatedAt'];
    }
}
