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
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['publishedAt'] = $publishedAt;
        $self['updatedAt'] = $updatedAt;
        $self['version'] = $version;

        return $self;
    }

    /**
     * The template's id.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The timestamp at which the template was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The timestamp at which the template was published.
     */
    public function withPublishedAt(string $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }

    /**
     * The timestamp at which the template was last updated.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * The version of the template.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
