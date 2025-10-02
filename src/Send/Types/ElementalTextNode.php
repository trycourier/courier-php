<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ElementalBaseNode;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * Represents a body of text to be rendered inside of the notification.
 */
class ElementalTextNode extends JsonSerializableType
{
    use ElementalBaseNode;

    /**
     * The text content displayed in the notification. Either this
     * field must be specified, or the elements field
     *
     * @var string $content
     */
    #[JsonProperty('content')]
    public string $content;

    /**
     * @var value-of<TextAlign> $align Text alignment.
     */
    #[JsonProperty('align')]
    public string $align;

    /**
     * @var ?value-of<TextStyle> $textStyle Allows the text to be rendered as a heading level.
     */
    #[JsonProperty('text_style')]
    public ?string $textStyle;

    /**
     * @var ?string $color Specifies the color of text. Can be any valid css color value
     */
    #[JsonProperty('color')]
    public ?string $color;

    /**
     * @var ?string $bold Apply bold to the text
     */
    #[JsonProperty('bold')]
    public ?string $bold;

    /**
     * @var ?string $italic Apply italics to the text
     */
    #[JsonProperty('italic')]
    public ?string $italic;

    /**
     * @var ?string $strikethrough Apply a strike through the text
     */
    #[JsonProperty('strikethrough')]
    public ?string $strikethrough;

    /**
     * @var ?string $underline Apply an underline to the text
     */
    #[JsonProperty('underline')]
    public ?string $underline;

    /**
     * @var ?array<string, Locale> $locales Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     */
    #[JsonProperty('locales'), ArrayType(['string' => Locale::class])]
    public ?array $locales;

    /**
     * @var ?'markdown' $format
     */
    #[JsonProperty('format')]
    public ?string $format;

    /**
     * @param array{
     *   content: string,
     *   align: value-of<TextAlign>,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     *   textStyle?: ?value-of<TextStyle>,
     *   color?: ?string,
     *   bold?: ?string,
     *   italic?: ?string,
     *   strikethrough?: ?string,
     *   underline?: ?string,
     *   locales?: ?array<string, Locale>,
     *   format?: ?'markdown',
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
        $this->content = $values['content'];
        $this->align = $values['align'];
        $this->textStyle = $values['textStyle'] ?? null;
        $this->color = $values['color'] ?? null;
        $this->bold = $values['bold'] ?? null;
        $this->italic = $values['italic'] ?? null;
        $this->strikethrough = $values['strikethrough'] ?? null;
        $this->underline = $values['underline'] ?? null;
        $this->locales = $values['locales'] ?? null;
        $this->format = $values['format'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
