<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_template = array{
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
    /** @use SdkModel<brand_template> */
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
        $obj = new self;

        $obj->enabled = $enabled;

        null !== $backgroundColor && $obj->backgroundColor = $backgroundColor;
        null !== $blocksBackgroundColor && $obj->blocksBackgroundColor = $blocksBackgroundColor;
        null !== $footer && $obj->footer = $footer;
        null !== $head && $obj->head = $head;
        null !== $header && $obj->header = $header;
        null !== $width && $obj->width = $width;

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
}
