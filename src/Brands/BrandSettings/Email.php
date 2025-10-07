<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSettings;

use Courier\Brands\BrandSettings\Email\Footer;
use Courier\Brands\BrandSettings\Email\Head;
use Courier\Brands\BrandSettings\Email\Header;
use Courier\Brands\BrandSettings\Email\TemplateOverride;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type email_alias = array{
 *   footer?: Footer|null,
 *   head?: Head|null,
 *   header?: Header|null,
 *   templateOverride?: TemplateOverride|null,
 * }
 */
final class Email implements BaseModel
{
    /** @use SdkModel<email_alias> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?Footer $footer;

    #[Api(nullable: true, optional: true)]
    public ?Head $head;

    #[Api(nullable: true, optional: true)]
    public ?Header $header;

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
        ?Footer $footer = null,
        ?Head $head = null,
        ?Header $header = null,
        ?TemplateOverride $templateOverride = null,
    ): self {
        $obj = new self;

        null !== $footer && $obj->footer = $footer;
        null !== $head && $obj->head = $head;
        null !== $header && $obj->header = $header;
        null !== $templateOverride && $obj->templateOverride = $templateOverride;

        return $obj;
    }

    public function withFooter(?Footer $footer): self
    {
        $obj = clone $this;
        $obj->footer = $footer;

        return $obj;
    }

    public function withHead(?Head $head): self
    {
        $obj = clone $this;
        $obj->head = $head;

        return $obj;
    }

    public function withHeader(?Header $header): self
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
