<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class NotificationContentHierarchy extends JsonSerializableType
{
    /**
     * @var ?string $parent
     */
    #[JsonProperty('parent')]
    public ?string $parent;

    /**
     * @var ?string $children
     */
    #[JsonProperty('children')]
    public ?string $children;

    /**
     * @param array{
     *   parent?: ?string,
     *   children?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->parent = $values['parent'] ?? null;
        $this->children = $values['children'] ?? null;
    }
}
