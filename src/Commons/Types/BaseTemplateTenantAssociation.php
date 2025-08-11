<?php

namespace Courier\Commons\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BaseTemplateTenantAssociation extends JsonSerializableType
{
    /**
     * @var string $id The template's id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $createdAt The timestamp at which the template was created
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var string $updatedAt The timestamp at which the template was last updated
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @var string $publishedAt The timestamp at which the template was published
     */
    #[JsonProperty('published_at')]
    public string $publishedAt;

    /**
     * @var string $version The version of the template
     */
    #[JsonProperty('version')]
    public string $version;

    /**
     * @param array{
     *   id: string,
     *   createdAt: string,
     *   updatedAt: string,
     *   publishedAt: string,
     *   version: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->publishedAt = $values['publishedAt'];
        $this->version = $values['version'];
    }
}
