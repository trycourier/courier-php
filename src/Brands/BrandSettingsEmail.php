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
     *
     * @param EmailFooter|array{
     *   content?: string|null, inheritDefault?: bool|null
     * }|null $footer
     * @param EmailHead|array{inheritDefault: bool, content?: string|null}|null $head
     * @param EmailHeader|array{
     *   logo: Logo, barColor?: string|null, inheritDefault?: bool|null
     * }|null $header
     * @param TemplateOverride|array{
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
     * }|null $templateOverride
     */
    public static function with(
        EmailFooter|array|null $footer = null,
        EmailHead|array|null $head = null,
        EmailHeader|array|null $header = null,
        TemplateOverride|array|null $templateOverride = null,
    ): self {
        $obj = new self;

        null !== $footer && $obj['footer'] = $footer;
        null !== $head && $obj['head'] = $head;
        null !== $header && $obj['header'] = $header;
        null !== $templateOverride && $obj['templateOverride'] = $templateOverride;

        return $obj;
    }

    /**
     * @param EmailFooter|array{
     *   content?: string|null, inheritDefault?: bool|null
     * }|null $footer
     */
    public function withFooter(EmailFooter|array|null $footer): self
    {
        $obj = clone $this;
        $obj['footer'] = $footer;

        return $obj;
    }

    /**
     * @param EmailHead|array{inheritDefault: bool, content?: string|null}|null $head
     */
    public function withHead(EmailHead|array|null $head): self
    {
        $obj = clone $this;
        $obj['head'] = $head;

        return $obj;
    }

    /**
     * @param EmailHeader|array{
     *   logo: Logo, barColor?: string|null, inheritDefault?: bool|null
     * }|null $header
     */
    public function withHeader(EmailHeader|array|null $header): self
    {
        $obj = clone $this;
        $obj['header'] = $header;

        return $obj;
    }

    /**
     * @param TemplateOverride|array{
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
     * }|null $templateOverride
     */
    public function withTemplateOverride(
        TemplateOverride|array|null $templateOverride
    ): self {
        $obj = clone $this;
        $obj['templateOverride'] = $templateOverride;

        return $obj;
    }
}
