<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type FilterShape from \Courier\Audiences\Filter
 *
 * @phpstan-type AudienceShape = array{
 *   id: string,
 *   createdAt: string,
 *   description: string,
 *   filter: Filter|FilterShape,
 *   name: string,
 *   updatedAt: string,
 * }
 */
final class Audience implements BaseModel
{
    /** @use SdkModel<AudienceShape> */
    use SdkModel;

    /**
     * A unique identifier representing the audience_id.
     */
    #[Required]
    public string $id;

    #[Required('created_at')]
    public string $createdAt;

    /**
     * A description of the audience.
     */
    #[Required]
    public string $description;

    /**
     * A single filter to use for filtering.
     */
    #[Required]
    public Filter $filter;

    /**
     * The name of the audience.
     */
    #[Required]
    public string $name;

    #[Required('updated_at')]
    public string $updatedAt;

    /**
     * `new Audience()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Audience::with(
     *   id: ...,
     *   createdAt: ...,
     *   description: ...,
     *   filter: ...,
     *   name: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Audience)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDescription(...)
     *   ->withFilter(...)
     *   ->withName(...)
     *   ->withUpdatedAt(...)
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
     * @param FilterShape $filter
     */
    public static function with(
        string $id,
        string $createdAt,
        string $description,
        Filter|array $filter,
        string $name,
        string $updatedAt,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['filter'] = $filter;
        $self['name'] = $name;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * A unique identifier representing the audience_id.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * A description of the audience.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * A single filter to use for filtering.
     *
     * @param FilterShape $filter
     */
    public function withFilter(Filter|array $filter): self
    {
        $self = clone $this;
        $self['filter'] = $filter;

        return $self;
    }

    /**
     * The name of the audience.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
