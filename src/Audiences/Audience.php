<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type audience_alias = array{
 *   id: string,
 *   createdAt: string,
 *   description: string,
 *   filter: Filter,
 *   name: string,
 *   updatedAt: string,
 * }
 */
final class Audience implements BaseModel, ResponseConverter
{
    /** @use SdkModel<audience_alias> */
    use SdkModel;

    use SdkResponse;

    /**
     * A unique identifier representing the audience_id.
     */
    #[Api]
    public string $id;

    #[Api('created_at')]
    public string $createdAt;

    /**
     * A description of the audience.
     */
    #[Api]
    public string $description;

    /**
     * A single filter to use for filtering.
     */
    #[Api]
    public Filter $filter;

    /**
     * The name of the audience.
     */
    #[Api]
    public string $name;

    #[Api('updated_at')]
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
     */
    public static function with(
        string $id,
        string $createdAt,
        string $description,
        Filter $filter,
        string $name,
        string $updatedAt,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->createdAt = $createdAt;
        $obj->description = $description;
        $obj->filter = $filter;
        $obj->name = $name;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * A unique identifier representing the audience_id.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * A description of the audience.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * A single filter to use for filtering.
     */
    public function withFilter(Filter $filter): self
    {
        $obj = clone $this;
        $obj->filter = $filter;

        return $obj;
    }

    /**
     * The name of the audience.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }
}
