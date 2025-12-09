<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationGetContent\Block\Content\NotificationContentHierarchy;
use Courier\Notifications\NotificationGetContent\Block\Locale;
use Courier\Notifications\NotificationGetContent\Block\Type;

/**
 * @phpstan-type BlockShape = array{
 *   id: string,
 *   type: value-of<Type>,
 *   alias?: string|null,
 *   checksum?: string|null,
 *   content?: string|null|NotificationContentHierarchy,
 *   context?: string|null,
 *   locales?: array<string,string|\Courier\Notifications\NotificationGetContent\Block\Locale\NotificationContentHierarchy>|null,
 * }
 */
final class Block implements BaseModel
{
    /** @use SdkModel<BlockShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional(nullable: true)]
    public ?string $alias;

    #[Optional(nullable: true)]
    public ?string $checksum;

    #[Optional(nullable: true)]
    public string|NotificationContentHierarchy|null $content;

    #[Optional(nullable: true)]
    public ?string $context;

    /**
     * @var array<string,string|Locale\NotificationContentHierarchy>|null $locales
     */
    #[Optional(map: Locale::class, nullable: true)]
    public ?array $locales;

    /**
     * `new Block()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Block::with(id: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Block)->withID(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param string|NotificationContentHierarchy|array{
     *   children?: string|null, parent?: string|null
     * }|null $content
     * @param array<string,string|Locale\NotificationContentHierarchy|array{
     *   children?: string|null, parent?: string|null
     * }>|null $locales
     */
    public static function with(
        string $id,
        Type|string $type,
        ?string $alias = null,
        ?string $checksum = null,
        string|NotificationContentHierarchy|array|null $content = null,
        ?string $context = null,
        ?array $locales = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['type'] = $type;

        null !== $alias && $self['alias'] = $alias;
        null !== $checksum && $self['checksum'] = $checksum;
        null !== $content && $self['content'] = $content;
        null !== $context && $self['context'] = $context;
        null !== $locales && $self['locales'] = $locales;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withAlias(?string $alias): self
    {
        $self = clone $this;
        $self['alias'] = $alias;

        return $self;
    }

    public function withChecksum(?string $checksum): self
    {
        $self = clone $this;
        $self['checksum'] = $checksum;

        return $self;
    }

    /**
     * @param string|NotificationContentHierarchy|array{
     *   children?: string|null, parent?: string|null
     * }|null $content
     */
    public function withContent(
        string|NotificationContentHierarchy|array|null $content
    ): self {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    public function withContext(?string $context): self
    {
        $self = clone $this;
        $self['context'] = $context;

        return $self;
    }

    /**
     * @param array<string,string|Locale\NotificationContentHierarchy|array{
     *   children?: string|null, parent?: string|null
     * }>|null $locales
     */
    public function withLocales(?array $locales): self
    {
        $self = clone $this;
        $self['locales'] = $locales;

        return $self;
    }
}
