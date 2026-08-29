<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalTextNode\Align;
use Courier\ElementalTextNode\Format;

/**
 * Represents a body of text to be rendered inside of the notification.
 *
 * @phpstan-import-type LocaleItemShape from \Courier\LocaleItem
 *
 * @phpstan-type ElementalTextNodeShape = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   align?: null|Align|value-of<Align>,
 *   bold?: string|null,
 *   color?: string|null,
 *   content?: string|null,
 *   fontSize?: string|null,
 *   format?: null|Format|value-of<Format>,
 *   italic?: string|null,
 *   lineHeight?: string|null,
 *   locales?: array<string,LocaleItem|LocaleItemShape>|null,
 *   strikethrough?: string|null,
 *   textStyle?: null|TextStyle|value-of<TextStyle>,
 *   underline?: string|null,
 * }
 */
final class ElementalTextNode implements BaseModel
{
    /** @use SdkModel<ElementalTextNodeShape> */
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
     * Text alignment.
     *
     * @var value-of<Align>|null $align
     */
    #[Optional(enum: Align::class)]
    public ?string $align;

    /**
     * Apply bold to the text.
     */
    #[Optional(nullable: true)]
    public ?string $bold;

    /**
     * Specifies the color of text. Can be any valid css color value.
     */
    #[Optional(nullable: true)]
    public ?string $color;

    /**
     * The text content displayed in the notification. Either this
     * field must be specified, or the elements field.
     */
    #[Optional]
    public ?string $content;

    /**
     * CSS px font size for this text block, e.g. `16px`. Overrides the size of the `text_style` preset. Email only.
     */
    #[Optional('font_size', nullable: true)]
    public ?string $fontSize;

    /** @var value-of<Format>|null $format */
    #[Optional(enum: Format::class, nullable: true)]
    public ?string $format;

    /**
     * Apply italics to the text.
     */
    #[Optional(nullable: true)]
    public ?string $italic;

    /**
     * CSS line height for this text block, as a px value or a unitless multiplier, e.g. `24px` or `1.5`. Email only.
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

    /**
     * Apply a strike through the text.
     */
    #[Optional(nullable: true)]
    public ?string $strikethrough;

    /** @var value-of<TextStyle>|null $textStyle */
    #[Optional('text_style', enum: TextStyle::class)]
    public ?string $textStyle;

    /**
     * Apply an underline to the text.
     */
    #[Optional(nullable: true)]
    public ?string $underline;

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
     * @param Align|value-of<Align>|null $align
     * @param Format|value-of<Format>|null $format
     * @param array<string,LocaleItem|LocaleItemShape>|null $locales
     * @param TextStyle|value-of<TextStyle>|null $textStyle
     */
    public static function with(
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        Align|string|null $align = null,
        ?string $bold = null,
        ?string $color = null,
        ?string $content = null,
        ?string $fontSize = null,
        Format|string|null $format = null,
        ?string $italic = null,
        ?string $lineHeight = null,
        ?array $locales = null,
        ?string $strikethrough = null,
        TextStyle|string|null $textStyle = null,
        ?string $underline = null,
    ): self {
        $self = new self;

        null !== $channels && $self['channels'] = $channels;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $align && $self['align'] = $align;
        null !== $bold && $self['bold'] = $bold;
        null !== $color && $self['color'] = $color;
        null !== $content && $self['content'] = $content;
        null !== $fontSize && $self['fontSize'] = $fontSize;
        null !== $format && $self['format'] = $format;
        null !== $italic && $self['italic'] = $italic;
        null !== $lineHeight && $self['lineHeight'] = $lineHeight;
        null !== $locales && $self['locales'] = $locales;
        null !== $strikethrough && $self['strikethrough'] = $strikethrough;
        null !== $textStyle && $self['textStyle'] = $textStyle;
        null !== $underline && $self['underline'] = $underline;

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
     * Text alignment.
     *
     * @param Align|value-of<Align> $align
     */
    public function withAlign(Align|string $align): self
    {
        $self = clone $this;
        $self['align'] = $align;

        return $self;
    }

    /**
     * Apply bold to the text.
     */
    public function withBold(?string $bold): self
    {
        $self = clone $this;
        $self['bold'] = $bold;

        return $self;
    }

    /**
     * Specifies the color of text. Can be any valid css color value.
     */
    public function withColor(?string $color): self
    {
        $self = clone $this;
        $self['color'] = $color;

        return $self;
    }

    /**
     * The text content displayed in the notification. Either this
     * field must be specified, or the elements field.
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * CSS px font size for this text block, e.g. `16px`. Overrides the size of the `text_style` preset. Email only.
     */
    public function withFontSize(?string $fontSize): self
    {
        $self = clone $this;
        $self['fontSize'] = $fontSize;

        return $self;
    }

    /**
     * @param Format|value-of<Format>|null $format
     */
    public function withFormat(Format|string|null $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Apply italics to the text.
     */
    public function withItalic(?string $italic): self
    {
        $self = clone $this;
        $self['italic'] = $italic;

        return $self;
    }

    /**
     * CSS line height for this text block, as a px value or a unitless multiplier, e.g. `24px` or `1.5`. Email only.
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
     * Apply a strike through the text.
     */
    public function withStrikethrough(?string $strikethrough): self
    {
        $self = clone $this;
        $self['strikethrough'] = $strikethrough;

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

    /**
     * Apply an underline to the text.
     */
    public function withUnderline(?string $underline): self
    {
        $self = clone $this;
        $self['underline'] = $underline;

        return $self;
    }
}
