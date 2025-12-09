<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationGetContent\Block;
use Courier\Notifications\NotificationGetContent\Block\Content\NotificationContentHierarchy;
use Courier\Notifications\NotificationGetContent\Block\Type;
use Courier\Notifications\NotificationGetContent\Channel;
use Courier\Notifications\NotificationGetContent\Channel\Content;
use Courier\Notifications\NotificationGetContent\Channel\Locale;

/**
 * @phpstan-type NotificationGetContentShape = array{
 *   blocks?: list<Block>|null,
 *   channels?: list<Channel>|null,
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
     * @param list<Block|array{
     *   id: string,
     *   type: value-of<Type>,
     *   alias?: string|null,
     *   checksum?: string|null,
     *   content?: string|NotificationContentHierarchy|null,
     *   context?: string|null,
     *   locales?: array<string,string|Block\Locale\NotificationContentHierarchy>|null,
     * }>|null $blocks
     * @param list<Channel|array{
     *   id: string,
     *   checksum?: string|null,
     *   content?: Content|null,
     *   locales?: array<string,Locale>|null,
     *   type?: string|null,
     * }>|null $channels
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
     * @param list<Block|array{
     *   id: string,
     *   type: value-of<Type>,
     *   alias?: string|null,
     *   checksum?: string|null,
     *   content?: string|NotificationContentHierarchy|null,
     *   context?: string|null,
     *   locales?: array<string,string|Block\Locale\NotificationContentHierarchy>|null,
     * }>|null $blocks
     */
    public function withBlocks(?array $blocks): self
    {
        $self = clone $this;
        $self['blocks'] = $blocks;

        return $self;
    }

    /**
     * @param list<Channel|array{
     *   id: string,
     *   checksum?: string|null,
     *   content?: Content|null,
     *   locales?: array<string,Locale>|null,
     *   type?: string|null,
     * }>|null $channels
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
