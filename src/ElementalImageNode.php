<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Used to embed an image into the notification.
 *
 * @phpstan-type ElementalImageNodeShape = array{
 *   channels?: list<string>|null,
 *   if?: string|null,
 *   loop?: string|null,
 *   ref?: string|null,
 *   src: string,
 *   align?: null|Alignment|value-of<Alignment>,
 *   altText?: string|null,
 *   borderColor?: string|null,
 *   borderSize?: string|null,
 *   href?: string|null,
 *   padding?: string|null,
 *   width?: string|null,
 * }
 */
final class ElementalImageNode implements BaseModel
{
    /** @use SdkModel<ElementalImageNodeShape> */
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
     * The source of the image.
     */
    #[Required]
    public string $src;

    /** @var value-of<Alignment>|null $align */
    #[Optional(enum: Alignment::class)]
    public ?string $align;

    /**
     * Alternate text for the image.
     */
    #[Optional(nullable: true)]
    public ?string $altText;

    /**
     * CSS border color applied to the image. For example, `#ccc`.
     */
    #[Optional('border_color', nullable: true)]
    public ?string $borderColor;

    /**
     * CSS border width applied to the image. For example, `1px`.
     */
    #[Optional('border_size', nullable: true)]
    public ?string $borderSize;

    /**
     * A URL to link to when the image is clicked.
     */
    #[Optional(nullable: true)]
    public ?string $href;

    /**
     * CSS padding applied around the image. For example, `10px`.
     */
    #[Optional(nullable: true)]
    public ?string $padding;

    /**
     * CSS width properties to apply to the image. For example, 50px.
     */
    #[Optional(nullable: true)]
    public ?string $width;

    /**
     * `new ElementalImageNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementalImageNode::with(src: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementalImageNode)->withSrc(...)
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
     */
    public static function with(
        string $src,
        ?array $channels = null,
        ?string $if = null,
        ?string $loop = null,
        ?string $ref = null,
        Alignment|string|null $align = null,
        ?string $altText = null,
        ?string $borderColor = null,
        ?string $borderSize = null,
        ?string $href = null,
        ?string $padding = null,
        ?string $width = null,
    ): self {
        $self = new self;

        $self['src'] = $src;

        null !== $channels && $self['channels'] = $channels;
        null !== $if && $self['if'] = $if;
        null !== $loop && $self['loop'] = $loop;
        null !== $ref && $self['ref'] = $ref;
        null !== $align && $self['align'] = $align;
        null !== $altText && $self['altText'] = $altText;
        null !== $borderColor && $self['borderColor'] = $borderColor;
        null !== $borderSize && $self['borderSize'] = $borderSize;
        null !== $href && $self['href'] = $href;
        null !== $padding && $self['padding'] = $padding;
        null !== $width && $self['width'] = $width;

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
     * The source of the image.
     */
    public function withSrc(string $src): self
    {
        $self = clone $this;
        $self['src'] = $src;

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
     * Alternate text for the image.
     */
    public function withAltText(?string $altText): self
    {
        $self = clone $this;
        $self['altText'] = $altText;

        return $self;
    }

    /**
     * CSS border color applied to the image. For example, `#ccc`.
     */
    public function withBorderColor(?string $borderColor): self
    {
        $self = clone $this;
        $self['borderColor'] = $borderColor;

        return $self;
    }

    /**
     * CSS border width applied to the image. For example, `1px`.
     */
    public function withBorderSize(?string $borderSize): self
    {
        $self = clone $this;
        $self['borderSize'] = $borderSize;

        return $self;
    }

    /**
     * A URL to link to when the image is clicked.
     */
    public function withHref(?string $href): self
    {
        $self = clone $this;
        $self['href'] = $href;

        return $self;
    }

    /**
     * CSS padding applied around the image. For example, `10px`.
     */
    public function withPadding(?string $padding): self
    {
        $self = clone $this;
        $self['padding'] = $padding;

        return $self;
    }

    /**
     * CSS width properties to apply to the image. For example, 50px.
     */
    public function withWidth(?string $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
