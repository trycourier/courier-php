<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates\TemplateListResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\Templates\TemplateListResponse\Item\Data;

/**
 * @phpstan-type item_alias = array{
 *   id: string,
 *   createdAt: string,
 *   data: Data,
 *   publishedAt: string,
 *   updatedAt: string,
 *   version: string,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<item_alias> */
    use SdkModel;

    /**
     * The template's id.
     */
    #[Api]
    public string $id;

    /**
     * The timestamp at which the template was created.
     */
    #[Api('created_at')]
    public string $createdAt;

    /**
     * The template's data containing it's routing configs.
     */
    #[Api]
    public Data $data;

    /**
     * The timestamp at which the template was published.
     */
    #[Api('published_at')]
    public string $publishedAt;

    /**
     * The timestamp at which the template was last updated.
     */
    #[Api('updated_at')]
    public string $updatedAt;

    /**
     * The version of the template.
     */
    #[Api]
    public string $version;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   id: ...,
     *   createdAt: ...,
     *   data: ...,
     *   publishedAt: ...,
     *   updatedAt: ...,
     *   version: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withData(...)
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
        Data $data,
        string $publishedAt,
        string $updatedAt,
        string $version,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->createdAt = $createdAt;
        $obj->data = $data;
        $obj->publishedAt = $publishedAt;
        $obj->updatedAt = $updatedAt;
        $obj->version = $version;

        return $obj;
    }

    /**
     * The template's id.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * The timestamp at which the template was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * The template's data containing it's routing configs.
     */
    public function withData(Data $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * The timestamp at which the template was published.
     */
    public function withPublishedAt(string $publishedAt): self
    {
        $obj = clone $this;
        $obj->publishedAt = $publishedAt;

        return $obj;
    }

    /**
     * The timestamp at which the template was last updated.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * The version of the template.
     */
    public function withVersion(string $version): self
    {
        $obj = clone $this;
        $obj->version = $version;

        return $obj;
    }
}
