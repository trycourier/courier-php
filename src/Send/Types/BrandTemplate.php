<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BrandTemplate extends JsonSerializableType
{
    /**
     * @var ?string $backgroundColor
     */
    #[JsonProperty('backgroundColor')]
    public ?string $backgroundColor;

    /**
     * @var ?string $blocksBackgroundColor
     */
    #[JsonProperty('blocksBackgroundColor')]
    public ?string $blocksBackgroundColor;

    /**
     * @var bool $enabled
     */
    #[JsonProperty('enabled')]
    public bool $enabled;

    /**
     * @var ?string $footer
     */
    #[JsonProperty('footer')]
    public ?string $footer;

    /**
     * @var ?string $head
     */
    #[JsonProperty('head')]
    public ?string $head;

    /**
     * @var ?string $header
     */
    #[JsonProperty('header')]
    public ?string $header;

    /**
     * @var ?string $width
     */
    #[JsonProperty('width')]
    public ?string $width;

    /**
     * @param array{
     *   backgroundColor?: ?string,
     *   blocksBackgroundColor?: ?string,
     *   enabled: bool,
     *   footer?: ?string,
     *   head?: ?string,
     *   header?: ?string,
     *   width?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->backgroundColor = $values['backgroundColor'] ?? null;
        $this->blocksBackgroundColor = $values['blocksBackgroundColor'] ?? null;
        $this->enabled = $values['enabled'];
        $this->footer = $values['footer'] ?? null;
        $this->head = $values['head'] ?? null;
        $this->header = $values['header'] ?? null;
        $this->width = $values['width'] ?? null;
    }
}
