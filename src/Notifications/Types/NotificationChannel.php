<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class NotificationChannel extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var ?string $type
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var ?NotificationChannelContent $content
     */
    #[JsonProperty('content')]
    public ?NotificationChannelContent $content;

    /**
     * @var ?array<string, NotificationChannelContent> $locales
     */
    #[JsonProperty('locales'), ArrayType(['string' => NotificationChannelContent::class])]
    public ?array $locales;

    /**
     * @var ?string $checksum
     */
    #[JsonProperty('checksum')]
    public ?string $checksum;

    /**
     * @param array{
     *   id: string,
     *   type?: ?string,
     *   content?: ?NotificationChannelContent,
     *   locales?: ?array<string, NotificationChannelContent>,
     *   checksum?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->type = $values['type'] ?? null;
        $this->content = $values['content'] ?? null;
        $this->locales = $values['locales'] ?? null;
        $this->checksum = $values['checksum'] ?? null;
    }
}
