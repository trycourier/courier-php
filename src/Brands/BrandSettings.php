<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\BrandSettingsEmail\TemplateOverride;
use Courier\Brands\BrandSettingsInApp\Placement;
use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandSettingsShape = array{
 *   colors?: BrandColors|null,
 *   email?: BrandSettingsEmail|null,
 *   inapp?: BrandSettingsInApp|null,
 * }
 */
final class BrandSettings implements BaseModel
{
    /** @use SdkModel<BrandSettingsShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?BrandColors $colors;

    #[Optional(nullable: true)]
    public ?BrandSettingsEmail $email;

    #[Optional(nullable: true)]
    public ?BrandSettingsInApp $inapp;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BrandColors|array{
     *   primary?: string|null, secondary?: string|null
     * }|null $colors
     * @param BrandSettingsEmail|array{
     *   footer?: EmailFooter|null,
     *   head?: EmailHead|null,
     *   header?: EmailHeader|null,
     *   templateOverride?: TemplateOverride|null,
     * }|null $email
     * @param BrandSettingsInApp|array{
     *   colors: BrandColors,
     *   icons: Icons,
     *   widgetBackground: WidgetBackground,
     *   borderRadius?: string|null,
     *   disableMessageIcon?: bool|null,
     *   fontFamily?: string|null,
     *   placement?: value-of<Placement>|null,
     * }|null $inapp
     */
    public static function with(
        BrandColors|array|null $colors = null,
        BrandSettingsEmail|array|null $email = null,
        BrandSettingsInApp|array|null $inapp = null,
    ): self {
        $self = new self;

        null !== $colors && $self['colors'] = $colors;
        null !== $email && $self['email'] = $email;
        null !== $inapp && $self['inapp'] = $inapp;

        return $self;
    }

    /**
     * @param BrandColors|array{
     *   primary?: string|null, secondary?: string|null
     * }|null $colors
     */
    public function withColors(BrandColors|array|null $colors): self
    {
        $self = clone $this;
        $self['colors'] = $colors;

        return $self;
    }

    /**
     * @param BrandSettingsEmail|array{
     *   footer?: EmailFooter|null,
     *   head?: EmailHead|null,
     *   header?: EmailHeader|null,
     *   templateOverride?: TemplateOverride|null,
     * }|null $email
     */
    public function withEmail(BrandSettingsEmail|array|null $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * @param BrandSettingsInApp|array{
     *   colors: BrandColors,
     *   icons: Icons,
     *   widgetBackground: WidgetBackground,
     *   borderRadius?: string|null,
     *   disableMessageIcon?: bool|null,
     *   fontFamily?: string|null,
     *   placement?: value-of<Placement>|null,
     * }|null $inapp
     */
    public function withInapp(BrandSettingsInApp|array|null $inapp): self
    {
        $self = clone $this;
        $self['inapp'] = $inapp;

        return $self;
    }
}
