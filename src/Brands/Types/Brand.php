<?php

namespace Courier\Brands\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class Brand extends JsonSerializableType
{
    /**
     * @var int $created The date/time of when the brand was created. Represented in milliseconds since Unix epoch.
     */
    #[JsonProperty('created')]
    public int $created;

    /**
     * @var ?string $id Brand Identifier
     */
    #[JsonProperty('id')]
    public ?string $id;

    /**
     * @var string $name Brand name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var int $published The date/time of when the brand was published. Represented in milliseconds since Unix epoch.
     */
    #[JsonProperty('published')]
    public int $published;

    /**
     * @var BrandSettings $settings
     */
    #[JsonProperty('settings')]
    public BrandSettings $settings;

    /**
     * @var int $updated The date/time of when the brand was updated. Represented in milliseconds since Unix epoch.
     */
    #[JsonProperty('updated')]
    public int $updated;

    /**
     * @var ?BrandSnippets $snippets
     */
    #[JsonProperty('snippets')]
    public ?BrandSnippets $snippets;

    /**
     * @var string $version The version identifier for the brand
     */
    #[JsonProperty('version')]
    public string $version;

    /**
     * @param array{
     *   created: int,
     *   name: string,
     *   published: int,
     *   settings: BrandSettings,
     *   updated: int,
     *   version: string,
     *   id?: ?string,
     *   snippets?: ?BrandSnippets,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->created = $values['created'];
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'];
        $this->published = $values['published'];
        $this->settings = $values['settings'];
        $this->updated = $values['updated'];
        $this->snippets = $values['snippets'] ?? null;
        $this->version = $values['version'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
