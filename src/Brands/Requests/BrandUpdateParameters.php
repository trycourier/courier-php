<?php

namespace Courier\Brands\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Brands\Types\BrandSettings;
use Courier\Brands\Types\BrandSnippets;

class BrandUpdateParameters extends JsonSerializableType
{
    /**
     * @var string $name The name of the brand.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?BrandSettings $settings
     */
    #[JsonProperty('settings')]
    public ?BrandSettings $settings;

    /**
     * @var ?BrandSnippets $snippets
     */
    #[JsonProperty('snippets')]
    public ?BrandSnippets $snippets;

    /**
     * @param array{
     *   name: string,
     *   settings?: ?BrandSettings,
     *   snippets?: ?BrandSnippets,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->settings = $values['settings'] ?? null;
        $this->snippets = $values['snippets'] ?? null;
    }
}
