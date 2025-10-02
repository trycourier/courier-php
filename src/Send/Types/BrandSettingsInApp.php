<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Brands\Types\BrandColors;

class BrandSettingsInApp extends JsonSerializableType
{
    /**
     * @var ?string $borderRadius
     */
    #[JsonProperty('borderRadius')]
    public ?string $borderRadius;

    /**
     * @var ?bool $disableMessageIcon
     */
    #[JsonProperty('disableMessageIcon')]
    public ?bool $disableMessageIcon;

    /**
     * @var ?string $fontFamily
     */
    #[JsonProperty('fontFamily')]
    public ?string $fontFamily;

    /**
     * @var ?value-of<InAppPlacement> $placement
     */
    #[JsonProperty('placement')]
    public ?string $placement;

    /**
     * @var WidgetBackground $widgetBackground
     */
    #[JsonProperty('widgetBackground')]
    public WidgetBackground $widgetBackground;

    /**
     * @var BrandColors $colors
     */
    #[JsonProperty('colors')]
    public BrandColors $colors;

    /**
     * @var Icons $icons
     */
    #[JsonProperty('icons')]
    public Icons $icons;

    /**
     * @var Preferences $preferences
     */
    #[JsonProperty('preferences')]
    public Preferences $preferences;

    /**
     * @param array{
     *   widgetBackground: WidgetBackground,
     *   colors: BrandColors,
     *   icons: Icons,
     *   preferences: Preferences,
     *   borderRadius?: ?string,
     *   disableMessageIcon?: ?bool,
     *   fontFamily?: ?string,
     *   placement?: ?value-of<InAppPlacement>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->borderRadius = $values['borderRadius'] ?? null;
        $this->disableMessageIcon = $values['disableMessageIcon'] ?? null;
        $this->fontFamily = $values['fontFamily'] ?? null;
        $this->placement = $values['placement'] ?? null;
        $this->widgetBackground = $values['widgetBackground'];
        $this->colors = $values['colors'];
        $this->icons = $values['icons'];
        $this->preferences = $values['preferences'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
