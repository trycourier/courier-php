<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Notifications\NotificationContent\Block;
use Courier\Notifications\NotificationContent\Channel;

/**
 * @phpstan-type notification_content = array{
 *   blocks?: list<Block>|null,
 *   channels?: list<Channel>|null,
 *   checksum?: string|null,
 * }
 */
final class NotificationContent implements BaseModel, ResponseConverter
{
    /** @use SdkModel<notification_content> */
    use SdkModel;

    use SdkResponse;

    /** @var list<Block>|null $blocks */
    #[Api(list: Block::class, nullable: true, optional: true)]
    public ?array $blocks;

    /** @var list<Channel>|null $channels */
    #[Api(list: Channel::class, nullable: true, optional: true)]
    public ?array $channels;

    #[Api(nullable: true, optional: true)]
    public ?string $checksum;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Block>|null $blocks
     * @param list<Channel>|null $channels
     */
    public static function with(
        ?array $blocks = null,
        ?array $channels = null,
        ?string $checksum = null
    ): self {
        $obj = new self;

        null !== $blocks && $obj->blocks = $blocks;
        null !== $channels && $obj->channels = $channels;
        null !== $checksum && $obj->checksum = $checksum;

        return $obj;
    }

    /**
     * @param list<Block>|null $blocks
     */
    public function withBlocks(?array $blocks): self
    {
        $obj = clone $this;
        $obj->blocks = $blocks;

        return $obj;
    }

    /**
     * @param list<Channel>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $obj = clone $this;
        $obj->channels = $channels;

        return $obj;
    }

    public function withChecksum(?string $checksum): self
    {
        $obj = clone $this;
        $obj->checksum = $checksum;

        return $obj;
    }
}
