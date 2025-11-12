<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\BrandSettingsEmail\TemplateOverride;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandSettingsEmailShape = array{
 *   footer?: EmailFooter|null,
 *   head?: EmailHead|null,
 *   header?: EmailHeader|null,
 *   templateOverride?: TemplateOverride|null,
 * }
 */
final class BrandSettingsEmail implements BaseModel
{
    /** @use SdkModel<BrandSettingsEmailShape> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?EmailFooter $footer;

    #[Api(nullable: true, optional: true)]
    public ?EmailHead $head;

    #[Api(nullable: true, optional: true)]
    public ?EmailHeader $header;

    #[Api(nullable: true, optional: true)]
    public ?TemplateOverride $templateOverride;

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
        ?EmailFooter $footer = null,
        ?EmailHead $head = null,
        ?EmailHeader $header = null,
        ?TemplateOverride $templateOverride = null,
    ): self {
        $obj = new self;

        null !== $footer && $obj->footer = $footer;
        null !== $head && $obj->head = $head;
        null !== $header && $obj->header = $header;
        null !== $templateOverride && $obj->templateOverride = $templateOverride;

        return $obj;
    }

    public function withFooter(?EmailFooter $footer): self
    {
        $obj = clone $this;
        $obj->footer = $footer;

        return $obj;
    }

    public function withHead(?EmailHead $head): self
    {
        $obj = clone $this;
        $obj->head = $head;

        return $obj;
    }

    public function withHeader(?EmailHeader $header): self
    {
        $obj = clone $this;
        $obj->header = $header;

        return $obj;
    }

    public function withTemplateOverride(
        ?TemplateOverride $templateOverride
    ): self {
        $obj = clone $this;
        $obj->templateOverride = $templateOverride;

        return $obj;
    }
}
