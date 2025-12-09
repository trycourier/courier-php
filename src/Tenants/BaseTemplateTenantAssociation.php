<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BaseTemplateTenantAssociationShape = array{
 *   id: string,
 *   createdAt: string,
 *   publishedAt: string,
 *   updatedAt: string,
 *   version: string,
 * }
 */
final class BaseTemplateTenantAssociation implements BaseModel
{
    /** @use SdkModel<BaseTemplateTenantAssociationShape> */
    use SdkModel;

    /**
     * The template's id.
     */
    #[Required]
    public string $id;

    /**
     * The timestamp at which the template was created.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * The timestamp at which the template was published.
     */
    #[Required('published_at')]
    public string $publishedAt;

    /**
     * The timestamp at which the template was last updated.
     */
    #[Required('updated_at')]
    public string $updatedAt;

    /**
     * The version of the template.
     */
    #[Required]
    public string $version;

    /**
     * `new BaseTemplateTenantAssociation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BaseTemplateTenantAssociation::with(
     *   id: ..., createdAt: ..., publishedAt: ..., updatedAt: ..., version: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BaseTemplateTenantAssociation)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withPublishedAt(...)
     *   ->withUpdatedAt(...)
     *   ->withVersion(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $id,
        string $createdAt,
        string $publishedAt,
        string $updatedAt,
        string $version,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['createdAt'] = $createdAt;
        $obj['publishedAt'] = $publishedAt;
        $obj['updatedAt'] = $updatedAt;
        $obj['version'] = $version;

        return $obj;
    }

    /**
     * The template's id.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * The timestamp at which the template was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * The timestamp at which the template was published.
     */
    public function withPublishedAt(string $publishedAt): self
    {
        $obj = clone $this;
        $obj['publishedAt'] = $publishedAt;

        return $obj;
    }

    /**
     * The timestamp at which the template was last updated.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj['updatedAt'] = $updatedAt;

        return $obj;
    }

    /**
     * The version of the template.
     */
    public function withVersion(string $version): self
    {
        $obj = clone $this;
        $obj['version'] = $version;

        return $obj;
    }
}
