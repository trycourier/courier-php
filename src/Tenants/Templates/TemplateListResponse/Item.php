<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates\TemplateListResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRouting;
use Courier\Tenants\Templates\TemplateListResponse\Item\Data;

/**
 * @phpstan-type ItemShape = array{
 *   id: string,
 *   createdAt: string,
 *   publishedAt: string,
 *   updatedAt: string,
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
     * The template's data containing it's routing configs.
     */
    #[Required]
    public Data $data;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   id: ...,
     *   createdAt: ...,
     *   publishedAt: ...,
     *   updatedAt: ...,
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
     *
     * @param Data|array{routing: MessageRouting} $data
     */
    public static function with(
        string $id,
        string $createdAt,
        string $publishedAt,
        string $updatedAt,
        string $version,
        Data|array $data,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['publishedAt'] = $publishedAt;
        $self['updatedAt'] = $updatedAt;
        $self['version'] = $version;
        $self['data'] = $data;

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

    /**
     * The template's data containing it's routing configs.
     *
     * @param Data|array{routing: MessageRouting} $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
