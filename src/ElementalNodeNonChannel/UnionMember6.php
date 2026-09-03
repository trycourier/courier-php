<?php

declare(strict_types=1);

namespace Courier\ElementalNodeNonChannel;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalNodeNonChannel\UnionMember6\Type;
use Courier\LocaleItem;

/**
 * Raw HTML string inside an Elemental document. When rendering a message, this node is turned into output only for the email channel; for other channels it produces no blocks.
 *
 * @phpstan-import-type LocaleItemShape from \Courier\LocaleItem
 *
 * @phpstan-type UnionMember6Shape = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   content: string,
 *   locales?: array<string,LocaleItem|LocaleItemShape>|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class UnionMember6 implements BaseModel
{
    /** @use SdkModel<UnionMember6Shape> */
    use SdkModel;

    /** @var list<string>|null $channels */
    #[Optional(list: 'string', nullable: true)]
    public ?array $channels;

    #[Optional(nullable: true)]
    public ?string $if;

    #[Optional(nullable: true)]
    public ?string $loop;

    #[Optional(nullable: true)]
    public ?string $ref;

    /**
     * Raw HTML string to render inside the notification.
     */
    #[Required]
    public string $content;

    /**
     * Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     *
     * @var array<string,LocaleItem>|null $locales
     */
    #[Optional(map: LocaleItem::class, nullable: true)]
    public ?array $locales;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new UnionMember6()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember6::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember6)->withContent(...)
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
     * @param list<string>|null $channels
     * @param array<string,LocaleItem|LocaleItemShape>|null $locales
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $content,
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        ?array $locales = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['content'] = $content;

        null !== $channels && $self['channels'] = $channels;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $locales && $self['locales'] = $locales;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * @param list<string>|null $channels
     */
    public function withChannels(?array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    public function withIf(?string $if): self
    {
        $self = clone $this;
        $self['if'] = $if;

        return $self;
    }

    public function withLoop(?string $loop): self
    {
        $self = clone $this;
        $self['loop'] = $loop;

        return $self;
    }

    public function withRef(?string $ref): self
    {
        $self = clone $this;
        $self['ref'] = $ref;

        return $self;
    }

    /**
     * Raw HTML string to render inside the notification.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     *
     * @param array<string,LocaleItem|LocaleItemShape>|null $locales
     */
    public function withLocales(?array $locales): self
    {
        $self = clone $this;
        $self['locales'] = $locales;

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
}
