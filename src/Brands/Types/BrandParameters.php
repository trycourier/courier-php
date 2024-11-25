<?php

namespace Courier\Brands\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BrandParameters extends JsonSerializableType
{
    /**
     * @var ?string $id
     */
    #[JsonProperty('id')]
    public ?string $id;

    /**
     * @var string $name The name of the brand.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var BrandSettings $settings
     */
    #[JsonProperty('settings')]
    public BrandSettings $settings;

    /**
     * @var ?BrandSnippets $snippets
     */
    #[JsonProperty('snippets')]
    public ?BrandSnippets $snippets;

    /**
     * @param array{
     *   id?: ?string,
     *   name: string,
     *   settings: BrandSettings,
     *   snippets?: ?BrandSnippets,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'];
        $this->settings = $values['settings'];
        $this->snippets = $values['snippets'] ?? null;
    }
}
