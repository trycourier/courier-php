<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\BrandSettingsEmail\TemplateOverride;
use Courier\Brands\BrandSettingsInApp\Placement;
use Courier\Core\Attributes\Api;
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

    #[Api(nullable: true, optional: true)]
    public ?BrandColors $colors;

    #[Api(nullable: true, optional: true)]
    public ?BrandSettingsEmail $email;

    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        null !== $colors && $obj['colors'] = $colors;
        null !== $email && $obj['email'] = $email;
        null !== $inapp && $obj['inapp'] = $inapp;

        return $obj;
    }

    /**
     * @param BrandColors|array{
     *   primary?: string|null, secondary?: string|null
     * }|null $colors
     */
    public function withColors(BrandColors|array|null $colors): self
    {
        $obj = clone $this;
        $obj['colors'] = $colors;

        return $obj;
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
        $obj = clone $this;
        $obj['email'] = $email;

        return $obj;
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
        $obj = clone $this;
        $obj['inapp'] = $inapp;

        return $obj;
    }
}
