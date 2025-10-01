<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationGetContent\Block\Content\NotificationContentHierarchy;
use Courier\Notifications\NotificationGetContent\Block\Locale;
use Courier\Notifications\NotificationGetContent\Block\Locale\NotificationContentHierarchy as NotificationContentHierarchy1;
use Courier\Notifications\NotificationGetContent\Block\Type;

/**
 * @phpstan-type block_alias = array{
 *   id: string,
 *   type: value-of<Type>,
 *   alias?: string|null,
 *   checksum?: string|null,
 *   content?: string|null|NotificationContentHierarchy,
 *   context?: string|null,
 *   locales?: array<string, string|NotificationContentHierarchy1>|null,
 * }
 */
final class Block implements BaseModel
{
    /** @use SdkModel<block_alias> */
    use SdkModel;

    #[Api]
    public string $id;

    /** @var value-of<Type> $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api(nullable: true, optional: true)]
    public ?string $alias;

    #[Api(nullable: true, optional: true)]
    public ?string $checksum;

    #[Api(nullable: true, optional: true)]
    public string|NotificationContentHierarchy|null $content;

    #[Api(nullable: true, optional: true)]
    public ?string $context;

    /** @var array<string, string|NotificationContentHierarchy1>|null $locales */
    #[Api(map: Locale::class, nullable: true, optional: true)]
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
     * @param array<string, string|NotificationContentHierarchy1>|null $locales
     */
    public static function with(
        string $id,
        Type|string $type,
        ?string $alias = null,
        ?string $checksum = null,
        string|NotificationContentHierarchy|null $content = null,
        ?string $context = null,
        ?array $locales = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->type = $type instanceof Type ? $type->value : $type;

        null !== $alias && $obj->alias = $alias;
        null !== $checksum && $obj->checksum = $checksum;
        null !== $content && $obj->content = $content;
        null !== $context && $obj->context = $context;
        null !== $locales && $obj->locales = $locales;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj->type = $type instanceof Type ? $type->value : $type;

        return $obj;
    }

    public function withAlias(?string $alias): self
    {
        $obj = clone $this;
        $obj->alias = $alias;

        return $obj;
    }

    public function withChecksum(?string $checksum): self
    {
        $obj = clone $this;
        $obj->checksum = $checksum;

        return $obj;
    }

    public function withContent(
        string|NotificationContentHierarchy|null $content
    ): self {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }

    public function withContext(?string $context): self
    {
        $obj = clone $this;
        $obj->context = $context;

        return $obj;
    }

    /**
     * @param array<string, string|NotificationContentHierarchy1>|null $locales
     */
    public function withLocales(?array $locales): self
    {
        $obj = clone $this;
        $obj->locales = $locales;

        return $obj;
    }
}
