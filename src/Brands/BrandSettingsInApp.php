<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\BrandSettingsInApp\Placement;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BrandColorsShape from \Courier\Brands\BrandColors
 * @phpstan-import-type IconsShape from \Courier\Brands\Icons
 * @phpstan-import-type WidgetBackgroundShape from \Courier\Brands\WidgetBackground
 *
 * @phpstan-type BrandSettingsInAppShape = array{
 *   colors: BrandColors|BrandColorsShape,
 *   icons: Icons|IconsShape,
 *   widgetBackground: WidgetBackground|WidgetBackgroundShape,
 *   borderRadius?: string|null,
 *   disableMessageIcon?: bool|null,
 *   fontFamily?: string|null,
 *   placement?: null|Placement|value-of<Placement>,
 * }
 */
final class BrandSettingsInApp implements BaseModel
{
    /** @use SdkModel<BrandSettingsInAppShape> */
    use SdkModel;

    #[Required]
    public BrandColors $colors;

    #[Required]
    public Icons $icons;

    #[Required]
    public WidgetBackground $widgetBackground;

    #[Optional(nullable: true)]
    public ?string $borderRadius;

    #[Optional(nullable: true)]
    public ?bool $disableMessageIcon;

    #[Optional(nullable: true)]
    public ?string $fontFamily;

    /** @var value-of<Placement>|null $placement */
    #[Optional(enum: Placement::class, nullable: true)]
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
     * @param BrandColors|BrandColorsShape $colors
     * @param Icons|IconsShape $icons
     * @param WidgetBackground|WidgetBackgroundShape $widgetBackground
     * @param Placement|value-of<Placement>|null $placement
     */
    public static function with(
        BrandColors|array $colors,
        Icons|array $icons,
        WidgetBackground|array $widgetBackground,
        ?string $borderRadius = null,
        ?bool $disableMessageIcon = null,
        ?string $fontFamily = null,
        Placement|string|null $placement = null,
    ): self {
        $self = new self;

        $self['colors'] = $colors;
        $self['icons'] = $icons;
        $self['widgetBackground'] = $widgetBackground;

        null !== $borderRadius && $self['borderRadius'] = $borderRadius;
        null !== $disableMessageIcon && $self['disableMessageIcon'] = $disableMessageIcon;
        null !== $fontFamily && $self['fontFamily'] = $fontFamily;
        null !== $placement && $self['placement'] = $placement;

        return $self;
    }

    /**
     * @param BrandColors|BrandColorsShape $colors
     */
    public function withColors(BrandColors|array $colors): self
    {
        $self = clone $this;
        $self['colors'] = $colors;

        return $self;
    }

    /**
     * @param Icons|IconsShape $icons
     */
    public function withIcons(Icons|array $icons): self
    {
        $self = clone $this;
        $self['icons'] = $icons;

        return $self;
    }

    /**
     * @param WidgetBackground|WidgetBackgroundShape $widgetBackground
     */
    public function withWidgetBackground(
        WidgetBackground|array $widgetBackground
    ): self {
        $self = clone $this;
        $self['widgetBackground'] = $widgetBackground;

        return $self;
    }

    public function withBorderRadius(?string $borderRadius): self
    {
        $self = clone $this;
        $self['borderRadius'] = $borderRadius;

        return $self;
    }

    public function withDisableMessageIcon(?bool $disableMessageIcon): self
    {
        $self = clone $this;
        $self['disableMessageIcon'] = $disableMessageIcon;

        return $self;
    }

    public function withFontFamily(?string $fontFamily): self
    {
        $self = clone $this;
        $self['fontFamily'] = $fontFamily;

        return $self;
    }

    /**
     * @param Placement|value-of<Placement>|null $placement
     */
    public function withPlacement(Placement|string|null $placement): self
    {
        $self = clone $this;
        $self['placement'] = $placement;

        return $self;
    }
}
