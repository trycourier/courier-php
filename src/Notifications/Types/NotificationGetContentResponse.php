<?php

namespace Courier\Notifications\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class NotificationGetContentResponse extends JsonSerializableType
{
    /**
     * @var ?array<NotificationBlock> $blocks
     */
    #[JsonProperty('blocks'), ArrayType([NotificationBlock::class])]
    public ?array $blocks;

    /**
     * @var ?array<NotificationChannel> $channels
     */
    #[JsonProperty('channels'), ArrayType([NotificationChannel::class])]
    public ?array $channels;

    /**
     * @var ?string $checksum
     */
    #[JsonProperty('checksum')]
    public ?string $checksum;

    /**
     * @param array{
     *   blocks?: ?array<NotificationBlock>,
     *   channels?: ?array<NotificationChannel>,
     *   checksum?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->blocks = $values['blocks'] ?? null;
        $this->channels = $values['channels'] ?? null;
        $this->checksum = $values['checksum'] ?? null;
    }
}
