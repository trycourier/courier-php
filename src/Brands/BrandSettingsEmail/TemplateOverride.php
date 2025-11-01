<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSettingsEmail;

use Courier\Brands\BrandTemplate;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type TemplateOverrideShape = array{
 *   enabled: bool,
 *   backgroundColor?: string|null,
 *   blocksBackgroundColor?: string|null,
 *   footer?: string|null,
 *   head?: string|null,
 *   header?: string|null,
 *   width?: string|null,
 *   mjml: BrandTemplate,
 *   footerBackgroundColor?: string|null,
 *   footerFullWidth?: bool|null,
 * }
 */
final class TemplateOverride implements BaseModel
{
    /** @use SdkModel<TemplateOverrideShape> */
    use SdkModel;

    #[Api]
    public bool $enabled;

    #[Api(nullable: true, optional: true)]
    public ?string $backgroundColor;

    #[Api(nullable: true, optional: true)]
    public ?string $blocksBackgroundColor;

    #[Api(nullable: true, optional: true)]
    public ?string $footer;

    #[Api(nullable: true, optional: true)]
    public ?string $head;

    #[Api(nullable: true, optional: true)]
    public ?string $header;

    #[Api(nullable: true, optional: true)]
    public ?string $width;

    #[Api]
    public BrandTemplate $mjml;

    #[Api(nullable: true, optional: true)]
    public ?string $footerBackgroundColor;

    #[Api(nullable: true, optional: true)]
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
     */
    public static function with(
        bool $enabled,
        BrandTemplate $mjml,
        ?string $backgroundColor = null,
        ?string $blocksBackgroundColor = null,
        ?string $footer = null,
        ?string $head = null,
        ?string $header = null,
        ?string $width = null,
        ?string $footerBackgroundColor = null,
        ?bool $footerFullWidth = null,
    ): self {
        $obj = new self;

        $obj->enabled = $enabled;
        $obj->mjml = $mjml;

        null !== $backgroundColor && $obj->backgroundColor = $backgroundColor;
        null !== $blocksBackgroundColor && $obj->blocksBackgroundColor = $blocksBackgroundColor;
        null !== $footer && $obj->footer = $footer;
        null !== $head && $obj->head = $head;
        null !== $header && $obj->header = $header;
        null !== $width && $obj->width = $width;
        null !== $footerBackgroundColor && $obj->footerBackgroundColor = $footerBackgroundColor;
        null !== $footerFullWidth && $obj->footerFullWidth = $footerFullWidth;

        return $obj;
    }

    public function withEnabled(bool $enabled): self
    {
        $obj = clone $this;
        $obj->enabled = $enabled;

        return $obj;
    }

    public function withBackgroundColor(?string $backgroundColor): self
    {
        $obj = clone $this;
        $obj->backgroundColor = $backgroundColor;

        return $obj;
    }

    public function withBlocksBackgroundColor(
        ?string $blocksBackgroundColor
    ): self {
        $obj = clone $this;
        $obj->blocksBackgroundColor = $blocksBackgroundColor;

        return $obj;
    }

    public function withFooter(?string $footer): self
    {
        $obj = clone $this;
        $obj->footer = $footer;

        return $obj;
    }

    public function withHead(?string $head): self
    {
        $obj = clone $this;
        $obj->head = $head;

        return $obj;
    }

    public function withHeader(?string $header): self
    {
        $obj = clone $this;
        $obj->header = $header;

        return $obj;
    }

    public function withWidth(?string $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }

    public function withMjml(BrandTemplate $mjml): self
    {
        $obj = clone $this;
        $obj->mjml = $mjml;

        return $obj;
    }

    public function withFooterBackgroundColor(
        ?string $footerBackgroundColor
    ): self {
        $obj = clone $this;
        $obj->footerBackgroundColor = $footerBackgroundColor;

        return $obj;
    }

    public function withFooterFullWidth(?bool $footerFullWidth): self
    {
        $obj = clone $this;
        $obj->footerFullWidth = $footerFullWidth;

        return $obj;
    }
}
