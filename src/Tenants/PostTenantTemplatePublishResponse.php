<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Response from publishing a tenant template.
 *
 * @phpstan-type PostTenantTemplatePublishResponseShape = array{
 *   id: string, publishedAt: string, version: string
 * }
 */
final class PostTenantTemplatePublishResponse implements BaseModel
{
    /** @use SdkModel<PostTenantTemplatePublishResponseShape> */
    use SdkModel;

    /**
     * The template ID.
     */
    #[Required]
    public string $id;

    /**
     * The timestamp when the template was published.
     */
    #[Required('published_at')]
    public string $publishedAt;

    /**
     * The published version of the template.
     */
    #[Required]
    public string $version;

    /**
     * `new PostTenantTemplatePublishResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PostTenantTemplatePublishResponse::with(id: ..., publishedAt: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PostTenantTemplatePublishResponse)
     *   ->withID(...)
     *   ->withPublishedAt(...)
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
        string $publishedAt,
        string $version
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['publishedAt'] = $publishedAt;
        $self['version'] = $version;

        return $self;
    }

    /**
     * The template ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The timestamp when the template was published.
     */
    public function withPublishedAt(string $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }

    /**
     * The published version of the template.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
