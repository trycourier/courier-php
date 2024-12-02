<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BrandSettingsEmail extends JsonSerializableType
{
    /**
     * @var ?BrandTemplateOverride $templateOverride
     */
    #[JsonProperty('templateOverride')]
    public ?BrandTemplateOverride $templateOverride;

    /**
     * @var ?EmailHead $head
     */
    #[JsonProperty('head')]
    public ?EmailHead $head;

    /**
     * @var ?EmailFooter $footer
     */
    #[JsonProperty('footer')]
    public ?EmailFooter $footer;

    /**
     * @var ?EmailHeader $header
     */
    #[JsonProperty('header')]
    public ?EmailHeader $header;

    /**
     * @param array{
     *   templateOverride?: ?BrandTemplateOverride,
     *   head?: ?EmailHead,
     *   footer?: ?EmailFooter,
     *   header?: ?EmailHeader,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->templateOverride = $values['templateOverride'] ?? null;
        $this->head = $values['head'] ?? null;
        $this->footer = $values['footer'] ?? null;
        $this->header = $values['header'] ?? null;
    }
}
