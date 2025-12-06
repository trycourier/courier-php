<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BaseTemplateTenantAssociationShape = array{
 *   id: string,
 *   created_at: string,
 *   published_at: string,
 *   updated_at: string,
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
    #[Api]
    public string $id;

    /**
     * The timestamp at which the template was created.
     */
    #[Api]
    public string $created_at;

    /**
     * The timestamp at which the template was published.
     */
    #[Api]
    public string $published_at;

    /**
     * The timestamp at which the template was last updated.
     */
    #[Api]
    public string $updated_at;

    /**
     * The version of the template.
     */
    #[Api]
    public string $version;

    /**
     * `new BaseTemplateTenantAssociation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BaseTemplateTenantAssociation::with(
     *   id: ..., created_at: ..., published_at: ..., updated_at: ..., version: ...
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
        string $created_at,
        string $published_at,
        string $updated_at,
        string $version,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['created_at'] = $created_at;
        $obj['published_at'] = $published_at;
        $obj['updated_at'] = $updated_at;
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
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * The timestamp at which the template was published.
     */
    public function withPublishedAt(string $publishedAt): self
    {
        $obj = clone $this;
        $obj['published_at'] = $publishedAt;

        return $obj;
    }

    /**
     * The timestamp at which the template was last updated.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

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
