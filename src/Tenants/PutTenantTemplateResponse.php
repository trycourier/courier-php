<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Response from creating or updating a tenant notification template.
 *
 * @phpstan-type PutTenantTemplateResponseShape = array{
 *   id: string, version: string, publishedAt?: string|null
 * }
 */
final class PutTenantTemplateResponse implements BaseModel
{
    /** @use SdkModel<PutTenantTemplateResponseShape> */
    use SdkModel;

    /**
     * The template ID.
     */
    #[Required]
    public string $id;

    /**
     * The version of the saved template.
     */
    #[Required]
    public string $version;

    /**
     * The timestamp when the template was published. Only present if the template was published as part of this request.
     */
    #[Optional('published_at', nullable: true)]
    public ?string $publishedAt;

    /**
     * `new PutTenantTemplateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PutTenantTemplateResponse::with(id: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PutTenantTemplateResponse)->withID(...)->withVersion(...)
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
        string $version,
        ?string $publishedAt = null
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['version'] = $version;

        null !== $publishedAt && $self['publishedAt'] = $publishedAt;

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
     * The version of the saved template.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }

    /**
     * The timestamp when the template was published. Only present if the template was published as part of this request.
     */
    public function withPublishedAt(?string $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }
}
