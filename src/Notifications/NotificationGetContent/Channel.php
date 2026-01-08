<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationGetContent\Channel\Content;
use Courier\Notifications\NotificationGetContent\Channel\Locale;

/**
 * @phpstan-import-type ContentShape from \Courier\Notifications\NotificationGetContent\Channel\Content
 * @phpstan-import-type LocaleShape from \Courier\Notifications\NotificationGetContent\Channel\Locale
 *
 * @phpstan-type ChannelShape = array{
 *   id: string,
 *   checksum?: string|null,
 *   content?: null|Content|ContentShape,
 *   locales?: array<string,Locale|LocaleShape>|null,
 *   type?: string|null,
 * }
 */
final class Channel implements BaseModel
{
    /** @use SdkModel<ChannelShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Optional(nullable: true)]
    public ?string $checksum;

    #[Optional(nullable: true)]
    public ?Content $content;

    /** @var array<string,Locale>|null $locales */
    #[Optional(map: Locale::class, nullable: true)]
    public ?array $locales;

    #[Optional(nullable: true)]
    public ?string $type;

    /**
     * `new Channel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Channel::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Channel)->withID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Content|ContentShape|null $content
     * @param array<string,Locale|LocaleShape>|null $locales
     */
    public static function with(
        string $id,
        ?string $checksum = null,
        Content|array|null $content = null,
        ?array $locales = null,
        ?string $type = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $checksum && $self['checksum'] = $checksum;
        null !== $content && $self['content'] = $content;
        null !== $locales && $self['locales'] = $locales;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withChecksum(?string $checksum): self
    {
        $self = clone $this;
        $self['checksum'] = $checksum;

        return $self;
    }

    /**
     * @param Content|ContentShape|null $content
     */
    public function withContent(Content|array|null $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * @param array<string,Locale|LocaleShape>|null $locales
     */
    public function withLocales(?array $locales): self
    {
        $self = clone $this;
        $self['locales'] = $locales;

        return $self;
    }

    public function withType(?string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
