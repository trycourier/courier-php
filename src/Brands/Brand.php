<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_alias = array{
 *   created: int,
 *   name: string,
 *   published: int,
 *   settings: BrandSettings,
 *   updated: int,
 *   version: string,
 *   id?: string|null,
 *   snippets?: BrandSnippets|null,
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class Brand implements BaseModel
{
    /** @use SdkModel<brand_alias> */
    use SdkModel;

    /**
     * The date/time of when the brand was created. Represented in milliseconds since Unix epoch.
     */
    #[Api]
    public int $created;

    /**
     * Brand name.
     */
    #[Api]
    public string $name;

    /**
     * The date/time of when the brand was published. Represented in milliseconds since Unix epoch.
     */
    #[Api]
    public int $published;

    #[Api]
    public BrandSettings $settings;

    /**
     * The date/time of when the brand was updated. Represented in milliseconds since Unix epoch.
     */
    #[Api]
    public int $updated;

    /**
     * The version identifier for the brand.
     */
    #[Api]
    public string $version;

    /**
     * Brand Identifier.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $id;

    #[Api(nullable: true, optional: true)]
    public ?BrandSnippets $snippets;

    /**
     * `new Brand()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Brand::with(
     *   created: ...,
     *   name: ...,
     *   published: ...,
     *   settings: ...,
     *   updated: ...,
     *   version: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Brand)
     *   ->withCreated(...)
     *   ->withName(...)
     *   ->withPublished(...)
     *   ->withSettings(...)
     *   ->withUpdated(...)
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
        int $created,
        string $name,
        int $published,
        BrandSettings $settings,
        int $updated,
        string $version,
        ?string $id = null,
        ?BrandSnippets $snippets = null,
    ): self {
        $obj = new self;

        $obj->created = $created;
        $obj->name = $name;
        $obj->published = $published;
        $obj->settings = $settings;
        $obj->updated = $updated;
        $obj->version = $version;

        null !== $id && $obj->id = $id;
        null !== $snippets && $obj->snippets = $snippets;

        return $obj;
    }

    /**
     * The date/time of when the brand was created. Represented in milliseconds since Unix epoch.
     */
    public function withCreated(int $created): self
    {
        $obj = clone $this;
        $obj->created = $created;

        return $obj;
    }

    /**
     * Brand name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * The date/time of when the brand was published. Represented in milliseconds since Unix epoch.
     */
    public function withPublished(int $published): self
    {
        $obj = clone $this;
        $obj->published = $published;

        return $obj;
    }

    public function withSettings(BrandSettings $settings): self
    {
        $obj = clone $this;
        $obj->settings = $settings;

        return $obj;
    }

    /**
     * The date/time of when the brand was updated. Represented in milliseconds since Unix epoch.
     */
    public function withUpdated(int $updated): self
    {
        $obj = clone $this;
        $obj->updated = $updated;

        return $obj;
    }

    /**
     * The version identifier for the brand.
     */
    public function withVersion(string $version): self
    {
        $obj = clone $this;
        $obj->version = $version;

        return $obj;
    }

    /**
     * Brand Identifier.
     */
    public function withID(?string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withSnippets(?BrandSnippets $snippets): self
    {
        $obj = clone $this;
        $obj->snippets = $snippets;

        return $obj;
    }
}
