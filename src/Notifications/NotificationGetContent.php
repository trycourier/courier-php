<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationGetContent\Block;
use Courier\Notifications\NotificationGetContent\Channel;

/**
 * @phpstan-import-type BlockShape from \Courier\Notifications\NotificationGetContent\Block
 * @phpstan-import-type ChannelShape from \Courier\Notifications\NotificationGetContent\Channel
 *
 * @phpstan-type NotificationGetContentShape = array{
 *   blocks?: list<Block|BlockShape>|null,
 *   channels?: list<Channel|ChannelShape>|null,
 *   checksum?: string|null,
 * }
 */
final class NotificationGetContent implements BaseModel
{
    /** @use SdkModel<NotificationGetContentShape> */
    use SdkModel;

    /** @var list<Block>|null $blocks */
    #[Optional(list: Block::class, nullable: true)]
    public ?array $blocks;

    /** @var list<Channel>|null $channels */
    #[Optional(list: Channel::class, nullable: true)]
    public ?array $channels;

    #[Optional(nullable: true)]
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
     * @param list<Block|BlockShape>|null $blocks
     * @param list<Channel|ChannelShape>|null $channels
     */
    public static function with(
        ?array $blocks = null,
        ?array $channels = null,
        ?string $checksum = null
    ): self {
        $self = new self;

        null !== $blocks && $self['blocks'] = $blocks;
        null !== $channels && $self['channels'] = $channels;
        null !== $checksum && $self['checksum'] = $checksum;

        return $self;
    }

    /**
     * @param list<Block|BlockShape>|null $blocks
     */
    public function withBlocks(?array $blocks): self
    {
        $self = clone $this;
        $self['blocks'] = $blocks;

        return $self;
    }

    /**
     * @param list<Channel|ChannelShape>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    public function withChecksum(?string $checksum): self
    {
        $self = clone $this;
        $self['checksum'] = $checksum;

        return $self;
    }
}
