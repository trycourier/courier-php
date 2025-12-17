<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSettingsEmail;

use Courier\Brands\BrandTemplate;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BrandTemplateShape from \Courier\Brands\BrandTemplate
 *
 * @phpstan-type TemplateOverrideShape = array{
 *   enabled: bool,
 *   backgroundColor?: string|null,
 *   blocksBackgroundColor?: string|null,
 *   footer?: string|null,
 *   head?: string|null,
 *   header?: string|null,
 *   width?: string|null,
 *   mjml: BrandTemplate|BrandTemplateShape,
 *   footerBackgroundColor?: string|null,
 *   footerFullWidth?: bool|null,
 * }
 */
final class TemplateOverride implements BaseModel
{
    /** @use SdkModel<TemplateOverrideShape> */
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

    #[Required]
    public BrandTemplate $mjml;

    #[Optional(nullable: true)]
    public ?string $footerBackgroundColor;

    #[Optional(nullable: true)]
    public ?bool $footerFullWidth;

    /**
     * `new TemplateOverride()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateOverride::with(enabled: ..., mjml: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateOverride)->withEnabled(...)->withMjml(...)
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
     * @param BrandTemplateShape $mjml
     */
    public static function with(
        bool $enabled,
        BrandTemplate|array $mjml,
        ?string $backgroundColor = null,
        ?string $blocksBackgroundColor = null,
        ?string $footer = null,
        ?string $head = null,
        ?string $header = null,
        ?string $width = null,
        ?string $footerBackgroundColor = null,
        ?bool $footerFullWidth = null,
    ): self {
        $self = new self;

        $self['enabled'] = $enabled;
        $self['mjml'] = $mjml;

        null !== $backgroundColor && $self['backgroundColor'] = $backgroundColor;
        null !== $blocksBackgroundColor && $self['blocksBackgroundColor'] = $blocksBackgroundColor;
        null !== $footer && $self['footer'] = $footer;
        null !== $head && $self['head'] = $head;
        null !== $header && $self['header'] = $header;
        null !== $width && $self['width'] = $width;
        null !== $footerBackgroundColor && $self['footerBackgroundColor'] = $footerBackgroundColor;
        null !== $footerFullWidth && $self['footerFullWidth'] = $footerFullWidth;

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

    /**
     * @param BrandTemplateShape $mjml
     */
    public function withMjml(BrandTemplate|array $mjml): self
    {
        $self = clone $this;
        $self['mjml'] = $mjml;

        return $self;
    }

    public function withFooterBackgroundColor(
        ?string $footerBackgroundColor
    ): self {
        $self = clone $this;
        $self['footerBackgroundColor'] = $footerBackgroundColor;

        return $self;
    }

    public function withFooterFullWidth(?bool $footerFullWidth): self
    {
        $self = clone $this;
        $self['footerFullWidth'] = $footerFullWidth;

        return $self;
    }
}
