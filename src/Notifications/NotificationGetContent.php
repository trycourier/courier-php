<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationGetContent\Block;
use Courier\Notifications\NotificationGetContent\Channel;

/**
 * @phpstan-type notification_get_content = array{
 *   blocks?: list<Block>|null,
 *   channels?: list<Channel>|null,
 *   checksum?: string|null,
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class NotificationGetContent implements BaseModel
{
    /** @use SdkModel<notification_get_content> */
    use SdkModel;

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
