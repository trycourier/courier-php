<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Traits\BrandTemplate as BrandTemplate_;
use Courier\Send\Types\BrandTemplate;
use Courier\Core\Json\JsonProperty;

class BrandTemplateOverride extends JsonSerializableType
{
    use BrandTemplate_;

    /**
     * @var BrandTemplate $mjml
     */
    #[JsonProperty('mjml')]
    public BrandTemplate $mjml;

    /**
     * @var ?string $footerBackgroundColor
     */
    #[JsonProperty('footerBackgroundColor')]
    public ?string $footerBackgroundColor;

    /**
     * @var ?bool $footerFullWidth
     */
    #[JsonProperty('footerFullWidth')]
    public ?bool $footerFullWidth;

    /**
     * @param array{
     *   mjml: BrandTemplate,
     *   footerBackgroundColor?: ?string,
     *   footerFullWidth?: ?bool,
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
        $this->mjml = $values['mjml'];
        $this->footerBackgroundColor = $values['footerBackgroundColor'] ?? null;
        $this->footerFullWidth = $values['footerFullWidth'] ?? null;
        $this->backgroundColor = $values['backgroundColor'] ?? null;
        $this->blocksBackgroundColor = $values['blocksBackgroundColor'] ?? null;
        $this->enabled = $values['enabled'];
        $this->footer = $values['footer'] ?? null;
        $this->head = $values['head'] ?? null;
        $this->header = $values['header'] ?? null;
        $this->width = $values['width'] ?? null;
    }
}
