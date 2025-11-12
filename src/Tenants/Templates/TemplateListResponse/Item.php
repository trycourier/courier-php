<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates\TemplateListResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\Templates\TemplateListResponse\Item\Data;

/**
 * @phpstan-type ItemShape = array{
 *   id: string,
 *   created_at: string,
 *   published_at: string,
 *   updated_at: string,
 *   version: string,
 *   data: Data,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
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
     * The template's data containing it's routing configs.
     */
    #[Api]
    public Data $data;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   id: ...,
     *   created_at: ...,
     *   published_at: ...,
     *   updated_at: ...,
     *   version: ...,
     *   data: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withPublishedAt(...)
     *   ->withUpdatedAt(...)
     *   ->withVersion(...)
     *   ->withData(...)
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
        Data $data,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->created_at = $created_at;
        $obj->published_at = $published_at;
        $obj->updated_at = $updated_at;
        $obj->version = $version;
        $obj->data = $data;

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
        $obj->created_at = $createdAt;

        return $obj;
    }

    /**
     * The timestamp at which the template was published.
     */
    public function withPublishedAt(string $publishedAt): self
    {
        $obj = clone $this;
        $obj->published_at = $publishedAt;

        return $obj;
    }

    /**
     * The timestamp at which the template was last updated.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj->updated_at = $updatedAt;

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

    /**
     * The template's data containing it's routing configs.
     */
    public function withData(Data $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }
}
