<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;
use Courier\Core\Types\ArrayType;

class NotificationBlock extends JsonSerializableType
{
    /**
     * @var ?string $alias
     */
    #[JsonProperty('alias')]
    public ?string $alias;

    /**
     * @var ?string $context
     */
    #[JsonProperty('context')]
    public ?string $context;

    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var value-of<BlockType> $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string|NotificationContentHierarchy|null $content
     */
    #[JsonProperty('content'), Union('string', NotificationContentHierarchy::class, 'null')]
    public string|NotificationContentHierarchy|null $content;

    /**
     * @var ?array<string, string|NotificationContentHierarchy> $locales
     */
    #[JsonProperty('locales'), ArrayType(['string' => new Union('string', NotificationContentHierarchy::class)])]
    public ?array $locales;

    /**
     * @var ?string $checksum
     */
    #[JsonProperty('checksum')]
    public ?string $checksum;

    /**
     * @param array{
     *   alias?: ?string,
     *   context?: ?string,
     *   id: string,
     *   type: value-of<BlockType>,
     *   content?: string|NotificationContentHierarchy|null,
     *   locales?: ?array<string, string|NotificationContentHierarchy>,
     *   checksum?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->alias = $values['alias'] ?? null;
        $this->context = $values['context'] ?? null;
        $this->id = $values['id'];
        $this->type = $values['type'];
        $this->content = $values['content'] ?? null;
        $this->locales = $values['locales'] ?? null;
        $this->checksum = $values['checksum'] ?? null;
    }
}
