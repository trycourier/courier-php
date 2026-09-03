<?php

declare(strict_types=1);

namespace Courier\ElementalNodeNonChannel;

use Courier\Alignment;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalActionNode\Style;
use Courier\ElementalNodeNonChannel\UnionMember3\Type;
use Courier\LocaleItem;

/**
 * Allows the user to execute an action. Can be a button or a link.
 *
 * @phpstan-import-type LocaleItemShape from \Courier\LocaleItem
 *
 * @phpstan-type UnionMember3Shape = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   content: string,
 *   href: string,
 *   actionID?: string|null,
 *   align?: null|Alignment|value-of<Alignment>,
 *   backgroundColor?: string|null,
 *   borderRadius?: string|null,
 *   borderSize?: string|null,
 *   disableTracking?: bool|null,
 *   fontSize?: string|null,
 *   locales?: array<string,LocaleItem|LocaleItemShape>|null,
 *   padding?: string|null,
 *   style?: null|Style|value-of<Style>,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class UnionMember3 implements BaseModel
{
    /** @use SdkModel<UnionMember3Shape> */
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
     * The text content of the action shown to the user.
     */
    #[Required]
    public string $content;

    /**
     * The target URL of the action.
     */
    #[Required]
    public string $href;

    /**
     * A unique id used to identify the action when it is executed.
     */
    #[Optional('action_id', nullable: true)]
    public ?string $actionID;

    /** @var value-of<Alignment>|null $align */
    #[Optional(enum: Alignment::class)]
    public ?string $align;

    /**
     * The background color of the action button.
     */
    #[Optional('background_color', nullable: true)]
    public ?string $backgroundColor;

    /**
     * CSS border-radius applied to the action button. For example, `4px`.
     */
    #[Optional('border_radius', nullable: true)]
    public ?string $borderRadius;

    /**
     * CSS border width applied to the action button. For example, `1px`.
     */
    #[Optional('border_size', nullable: true)]
    public ?string $borderSize;

    /**
     * When true, the action's href is not rewritten for click-through tracking, even when click-through tracking is enabled for the workspace.
     */
    #[Optional('disable_tracking', nullable: true)]
    public ?bool $disableTracking;

    /**
     * CSS font-size applied to the action button label. For example, `14px`.
     */
    #[Optional('font_size', nullable: true)]
    public ?string $fontSize;

    /**
     * Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     *
     * @var array<string,LocaleItem>|null $locales
     */
    #[Optional(map: LocaleItem::class, nullable: true)]
    public ?array $locales;

    /**
     * CSS padding applied to the action button. For example, `8px 16px`.
     */
    #[Optional(nullable: true)]
    public ?string $padding;

    /**
     * Defaults to `button`.
     *
     * @var value-of<Style>|null $style
     */
    #[Optional(enum: Style::class, nullable: true)]
    public ?string $style;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new UnionMember3()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember3::with(content: ..., href: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember3)->withContent(...)->withHref(...)
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
     * @param Alignment|value-of<Alignment>|null $align
     * @param array<string,LocaleItem|LocaleItemShape>|null $locales
     * @param Style|value-of<Style>|null $style
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $content,
        string $href,
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        ?string $actionID = null,
        Alignment|string|null $align = null,
        ?string $backgroundColor = null,
        ?string $borderRadius = null,
        ?string $borderSize = null,
        ?bool $disableTracking = null,
        ?string $fontSize = null,
        ?array $locales = null,
        ?string $padding = null,
        Style|string|null $style = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['content'] = $content;
        $self['href'] = $href;

        null !== $channels && $self['channels'] = $channels;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $actionID && $self['actionID'] = $actionID;
        null !== $align && $self['align'] = $align;
        null !== $backgroundColor && $self['backgroundColor'] = $backgroundColor;
        null !== $borderRadius && $self['borderRadius'] = $borderRadius;
        null !== $borderSize && $self['borderSize'] = $borderSize;
        null !== $disableTracking && $self['disableTracking'] = $disableTracking;
        null !== $fontSize && $self['fontSize'] = $fontSize;
        null !== $locales && $self['locales'] = $locales;
        null !== $padding && $self['padding'] = $padding;
        null !== $style && $self['style'] = $style;
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
     * The text content of the action shown to the user.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * The target URL of the action.
     */
    public function withHref(string $href): self
    {
        $self = clone $this;
        $self['href'] = $href;

        return $self;
    }

    /**
     * A unique id used to identify the action when it is executed.
     */
    public function withActionID(?string $actionID): self
    {
        $self = clone $this;
        $self['actionID'] = $actionID;

        return $self;
    }

    /**
     * @param Alignment|value-of<Alignment> $align
     */
    public function withAlign(Alignment|string $align): self
    {
        $self = clone $this;
        $self['align'] = $align;

        return $self;
    }

    /**
     * The background color of the action button.
     */
    public function withBackgroundColor(?string $backgroundColor): self
    {
        $self = clone $this;
        $self['backgroundColor'] = $backgroundColor;

        return $self;
    }

    /**
     * CSS border-radius applied to the action button. For example, `4px`.
     */
    public function withBorderRadius(?string $borderRadius): self
    {
        $self = clone $this;
        $self['borderRadius'] = $borderRadius;

        return $self;
    }

    /**
     * CSS border width applied to the action button. For example, `1px`.
     */
    public function withBorderSize(?string $borderSize): self
    {
        $self = clone $this;
        $self['borderSize'] = $borderSize;

        return $self;
    }

    /**
     * When true, the action's href is not rewritten for click-through tracking, even when click-through tracking is enabled for the workspace.
     */
    public function withDisableTracking(?bool $disableTracking): self
    {
        $self = clone $this;
        $self['disableTracking'] = $disableTracking;

        return $self;
    }

    /**
     * CSS font-size applied to the action button label. For example, `14px`.
     */
    public function withFontSize(?string $fontSize): self
    {
        $self = clone $this;
        $self['fontSize'] = $fontSize;

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
     * CSS padding applied to the action button. For example, `8px 16px`.
     */
    public function withPadding(?string $padding): self
    {
        $self = clone $this;
        $self['padding'] = $padding;

        return $self;
    }

    /**
     * Defaults to `button`.
     *
     * @param Style|value-of<Style>|null $style
     */
    public function withStyle(Style|string|null $style): self
    {
        $self = clone $this;
        $self['style'] = $style;

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
