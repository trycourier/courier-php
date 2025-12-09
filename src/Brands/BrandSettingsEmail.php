<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\BrandSettingsEmail\TemplateOverride;
use Courier\Core\Attributes\Optional;
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

    #[Optional(nullable: true)]
    public ?EmailFooter $footer;

    #[Optional(nullable: true)]
    public ?EmailHead $head;

    #[Optional(nullable: true)]
    public ?EmailHeader $header;

    #[Optional(nullable: true)]
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
        $self = new self;

        null !== $footer && $self['footer'] = $footer;
        null !== $head && $self['head'] = $head;
        null !== $header && $self['header'] = $header;
        null !== $templateOverride && $self['templateOverride'] = $templateOverride;

        return $self;
    }

    /**
     * @param EmailFooter|array{
     *   content?: string|null, inheritDefault?: bool|null
     * }|null $footer
     */
    public function withFooter(EmailFooter|array|null $footer): self
    {
        $self = clone $this;
        $self['footer'] = $footer;

        return $self;
    }

    /**
     * @param EmailHead|array{inheritDefault: bool, content?: string|null}|null $head
     */
    public function withHead(EmailHead|array|null $head): self
    {
        $self = clone $this;
        $self['head'] = $head;

        return $self;
    }

    /**
     * @param EmailHeader|array{
     *   logo: Logo, barColor?: string|null, inheritDefault?: bool|null
     * }|null $header
     */
    public function withHeader(EmailHeader|array|null $header): self
    {
        $self = clone $this;
        $self['header'] = $header;

        return $self;
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
        $self = clone $this;
        $self['templateOverride'] = $templateOverride;

        return $self;
    }
}
