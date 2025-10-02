<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\ElementalBaseNode;
use Courier\Core\Json\JsonProperty;

/**
 * Used to embed an image into the notification.
 */
class ElementalImageNode extends JsonSerializableType
{
    use ElementalBaseNode;

    /**
     * @var string $src The source of the image.
     */
    #[JsonProperty('src')]
    public string $src;

    /**
     * @var ?string $href A URL to link to when the image is clicked.
     */
    #[JsonProperty('href')]
    public ?string $href;

    /**
     * @var ?value-of<IAlignment> $align The alignment of the image.
     */
    #[JsonProperty('align')]
    public ?string $align;

    /**
     * @var ?string $altText Alternate text for the image.
     */
    #[JsonProperty('altText')]
    public ?string $altText;

    /**
     * @var ?string $width CSS width properties to apply to the image. For example, 50px
     */
    #[JsonProperty('width')]
    public ?string $width;

    /**
     * @param array{
     *   src: string,
     *   channels?: ?array<string>,
     *   ref?: ?string,
     *   if?: ?string,
     *   loop?: ?string,
     *   href?: ?string,
     *   align?: ?value-of<IAlignment>,
     *   altText?: ?string,
     *   width?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->channels = $values['channels'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->loop = $values['loop'] ?? null;
        $this->src = $values['src'];
        $this->href = $values['href'] ?? null;
        $this->align = $values['align'] ?? null;
        $this->altText = $values['altText'] ?? null;
        $this->width = $values['width'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
