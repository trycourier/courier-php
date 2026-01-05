<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandTemplateShape = array{
 *   enabled: bool,
 *   backgroundColor?: string|null,
 *   blocksBackgroundColor?: string|null,
 *   footer?: string|null,
 *   head?: string|null,
 *   header?: string|null,
 *   width?: string|null,
 * }
 */
final class BrandTemplate implements BaseModel
{
    /** @use SdkModel<BrandTemplateShape> */
    use SdkModel;

    #[Required]
    public bool $enabled;

    #[Optional(nullable: true)]
    public ?string $backgroundColor;

    #[Optional(nullable: true)]
    public ?string $blocksBackgroundColor;

    #[Optional(nullable: true)]
    public ?string $footer;

    #[Optional(nullable: true)]
    public ?string $head;

    #[Optional(nullable: true)]
    public ?string $header;

    #[Optional(nullable: true)]
    public ?string $width;

    /**
     * `new BrandTemplate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandTemplate::with(enabled: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandTemplate)->withEnabled(...)
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
     */
    public static function with(
        bool $enabled,
        ?string $backgroundColor = null,
        ?string $blocksBackgroundColor = null,
        ?string $footer = null,
        ?string $head = null,
        ?string $header = null,
        ?string $width = null,
    ): self {
        $self = new self;

        $self['enabled'] = $enabled;

        null !== $backgroundColor && $self['backgroundColor'] = $backgroundColor;
        null !== $blocksBackgroundColor && $self['blocksBackgroundColor'] = $blocksBackgroundColor;
        null !== $footer && $self['footer'] = $footer;
        null !== $head && $self['head'] = $head;
        null !== $header && $self['header'] = $header;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    public function withBackgroundColor(?string $backgroundColor): self
    {
        $self = clone $this;
        $self['backgroundColor'] = $backgroundColor;

        return $self;
    }

    public function withBlocksBackgroundColor(
        ?string $blocksBackgroundColor
    ): self {
        $self = clone $this;
        $self['blocksBackgroundColor'] = $blocksBackgroundColor;

        return $self;
    }

    public function withFooter(?string $footer): self
    {
        $self = clone $this;
        $self['footer'] = $footer;

        return $self;
    }

    public function withHead(?string $head): self
    {
        $self = clone $this;
        $self['head'] = $head;

        return $self;
    }

    public function withHeader(?string $header): self
    {
        $self = clone $this;
        $self['header'] = $header;

        return $self;
    }

    public function withWidth(?string $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
