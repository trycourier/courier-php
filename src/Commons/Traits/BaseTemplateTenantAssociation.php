<?php

namespace Courier\Commons\Traits;

use Courier\Core\Json\JsonProperty;

/**
 * @property string $id
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $publishedAt
 * @property string $version
 */
trait BaseTemplateTenantAssociation
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
}
