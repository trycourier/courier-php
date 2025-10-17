<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\BrandSettingsInApp\Placement;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_settings_in_app = array{
 *   colors: BrandColors,
 *   icons: Icons,
 *   widgetBackground: WidgetBackground,
 *   borderRadius?: string|null,
 *   disableMessageIcon?: bool|null,
 *   fontFamily?: string|null,
 *   placement?: value-of<Placement>|null,
 * }
 */
final class BrandSettingsInApp implements BaseModel
{
    /** @use SdkModel<brand_settings_in_app> */
    use SdkModel;

    #[Api]
    public BrandColors $colors;

    #[Api]
    public Icons $icons;

    #[Api]
    public WidgetBackground $widgetBackground;

    #[Api(nullable: true, optional: true)]
    public ?string $borderRadius;

    #[Api(nullable: true, optional: true)]
    public ?bool $disableMessageIcon;

    #[Api(nullable: true, optional: true)]
    public ?string $fontFamily;

    /** @var value-of<Placement>|null $placement */
    #[Api(enum: Placement::class, nullable: true, optional: true)]
    public ?string $placement;

    /**
     * `new BrandSettingsInApp()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandSettingsInApp::with(colors: ..., icons: ..., widgetBackground: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandSettingsInApp)
     *   ->withColors(...)
     *   ->withIcons(...)
     *   ->withWidgetBackground(...)
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
     * @param Placement|value-of<Placement>|null $placement
     */
    public static function with(
        BrandColors $colors,
        Icons $icons,
        WidgetBackground $widgetBackground,
        ?string $borderRadius = null,
        ?bool $disableMessageIcon = null,
        ?string $fontFamily = null,
        Placement|string|null $placement = null,
    ): self {
        $obj = new self;

        $obj->colors = $colors;
        $obj->icons = $icons;
        $obj->widgetBackground = $widgetBackground;

        null !== $borderRadius && $obj->borderRadius = $borderRadius;
        null !== $disableMessageIcon && $obj->disableMessageIcon = $disableMessageIcon;
        null !== $fontFamily && $obj->fontFamily = $fontFamily;
        null !== $placement && $obj['placement'] = $placement;

        return $obj;
    }

    public function withColors(BrandColors $colors): self
    {
        $obj = clone $this;
        $obj->colors = $colors;

        return $obj;
    }

    public function withIcons(Icons $icons): self
    {
        $obj = clone $this;
        $obj->icons = $icons;

        return $obj;
    }

    public function withWidgetBackground(
        WidgetBackground $widgetBackground
    ): self {
        $obj = clone $this;
        $obj->widgetBackground = $widgetBackground;

        return $obj;
    }

    public function withBorderRadius(?string $borderRadius): self
    {
        $obj = clone $this;
        $obj->borderRadius = $borderRadius;

        return $obj;
    }

    public function withDisableMessageIcon(?bool $disableMessageIcon): self
    {
        $obj = clone $this;
        $obj->disableMessageIcon = $disableMessageIcon;

        return $obj;
    }

    public function withFontFamily(?string $fontFamily): self
    {
        $obj = clone $this;
        $obj->fontFamily = $fontFamily;

        return $obj;
    }

    /**
     * @param Placement|value-of<Placement>|null $placement
     */
    public function withPlacement(Placement|string|null $placement): self
    {
        $obj = clone $this;
        $obj['placement'] = $placement;

        return $obj;
    }
}
