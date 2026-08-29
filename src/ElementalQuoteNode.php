<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Renders a quote block.
 *
 * @phpstan-import-type LocaleItemShape from \Courier\LocaleItem
 *
 * @phpstan-type ElementalQuoteNodeShape = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   content: string,
 *   align?: null|Alignment|value-of<Alignment>,
 *   borderColor?: string|null,
 *   fontSize?: string|null,
 *   lineHeight?: string|null,
 *   locales?: array<string,LocaleItem|LocaleItemShape>|null,
 *   textStyle?: null|TextStyle|value-of<TextStyle>,
 * }
 */
final class ElementalQuoteNode implements BaseModel
{
    /** @use SdkModel<ElementalQuoteNodeShape> */
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
     * The text value of the quote.
     */
    #[Required]
    public string $content;

    /** @var value-of<Alignment>|null $align */
    #[Optional(enum: Alignment::class)]
    public ?string $align;

    /**
     * CSS border color property. For example, `#fff`.
     */
    #[Optional('border_color', nullable: true)]
    public ?string $borderColor;

    /**
     * CSS px font size for this quote block, e.g. `16px`. Overrides the size of the `text_style` preset. Email only.
     */
    #[Optional('font_size', nullable: true)]
    public ?string $fontSize;

    /**
     * CSS line height for this quote block, as a px value or a unitless multiplier, e.g. `24px` or `1.5`. Email only.
     */
    #[Optional('line_height', nullable: true)]
    public ?string $lineHeight;

    /**
     * Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     *
     * @var array<string,LocaleItem>|null $locales
     */
    #[Optional(map: LocaleItem::class, nullable: true)]
    public ?array $locales;

    /** @var value-of<TextStyle>|null $textStyle */
    #[Optional('text_style', enum: TextStyle::class)]
    public ?string $textStyle;

    /**
     * `new ElementalQuoteNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementalQuoteNode::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementalQuoteNode)->withContent(...)
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
     * @param TextStyle|value-of<TextStyle>|null $textStyle
     */
    public static function with(
        string $content,
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        Alignment|string|null $align = null,
        ?string $borderColor = null,
        ?string $fontSize = null,
        ?string $lineHeight = null,
        ?array $locales = null,
        TextStyle|string|null $textStyle = null,
    ): self {
        $self = new self;

        $self['content'] = $content;

        null !== $channels && $self['channels'] = $channels;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $align && $self['align'] = $align;
        null !== $borderColor && $self['borderColor'] = $borderColor;
        null !== $fontSize && $self['fontSize'] = $fontSize;
        null !== $lineHeight && $self['lineHeight'] = $lineHeight;
        null !== $locales && $self['locales'] = $locales;
        null !== $textStyle && $self['textStyle'] = $textStyle;

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
     * The text value of the quote.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

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
     * CSS border color property. For example, `#fff`.
     */
    public function withBorderColor(?string $borderColor): self
    {
        $self = clone $this;
        $self['borderColor'] = $borderColor;

        return $self;
    }

    /**
     * CSS px font size for this quote block, e.g. `16px`. Overrides the size of the `text_style` preset. Email only.
     */
    public function withFontSize(?string $fontSize): self
    {
        $self = clone $this;
        $self['fontSize'] = $fontSize;

        return $self;
    }

    /**
     * CSS line height for this quote block, as a px value or a unitless multiplier, e.g. `24px` or `1.5`. Email only.
     */
    public function withLineHeight(?string $lineHeight): self
    {
        $self = clone $this;
        $self['lineHeight'] = $lineHeight;

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
     * @param TextStyle|value-of<TextStyle> $textStyle
     */
    public function withTextStyle(TextStyle|string $textStyle): self
    {
        $self = clone $this;
        $self['textStyle'] = $textStyle;

        return $self;
    }
}
