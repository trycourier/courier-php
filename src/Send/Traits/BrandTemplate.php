<?php

namespace Courier\Send\Traits;

use Courier\Core\Json\JsonProperty;

trait BrandTemplate
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
}
