<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ElementalBaseNode;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * Renders a quote block.
 */
class ElementalQuoteNode extends JsonSerializableType
{
    use ElementalBaseNode;

    /**
     * @var string $content The text value of the quote.
     */
    #[JsonProperty('content')]
    public string $content;

    /**
     * @var ?value-of<IAlignment> $align Alignment of the quote.
     */
    #[JsonProperty('align')]
    public ?string $align;

    /**
     * @var ?string $borderColor CSS border color property. For example, `#fff`
     */
    #[JsonProperty('borderColor')]
    public ?string $borderColor;

    /**
     * @var value-of<TextStyle> $textStyle
     */
    #[JsonProperty('text_style')]
    public string $textStyle;

    /**
     * @var ?array<string, Locale> $locales Region specific content. See [locales docs](https://www.courier.com/docs/platform/content/elemental/locales/) for more details.
     */
    #[JsonProperty('locales'), ArrayType(['string' => Locale::class])]
    public ?array $locales;

    /**
     * @param array{
     *   content: string,
     *   textStyle: value-of<TextStyle>,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     *   align?: ?value-of<IAlignment>,
     *   borderColor?: ?string,
     *   locales?: ?array<string, Locale>,
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
        $this->align = $values['align'] ?? null;
        $this->borderColor = $values['borderColor'] ?? null;
        $this->textStyle = $values['textStyle'];
        $this->locales = $values['locales'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
