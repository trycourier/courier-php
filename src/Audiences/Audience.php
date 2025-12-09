<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\Filter\Operator;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AudienceShape = array{
 *   id: string,
 *   created_at: string,
 *   description: string,
 *   filter: Filter,
 *   name: string,
 *   updated_at: string,
 * }
 */
final class Audience implements BaseModel
{
    /** @use SdkModel<AudienceShape> */
    use SdkModel;

    /**
     * A unique identifier representing the audience_id.
     */
    #[Api]
    public string $id;

    #[Api]
    public string $created_at;

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

    #[Api]
    public string $updated_at;

    /**
     * `new Audience()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Audience::with(
     *   id: ...,
     *   created_at: ...,
     *   description: ...,
     *   filter: ...,
     *   name: ...,
     *   updated_at: ...,
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
     * @param Filter|array{
     *   operator: value-of<Operator>, path: string, value: string
     * } $filter
     */
    public static function with(
        string $id,
        string $created_at,
        string $description,
        Filter|array $filter,
        string $name,
        string $updated_at,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['created_at'] = $created_at;
        $obj['description'] = $description;
        $obj['filter'] = $filter;
        $obj['name'] = $name;
        $obj['updated_at'] = $updated_at;

        return $obj;
    }

    /**
     * A unique identifier representing the audience_id.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * A description of the audience.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * A single filter to use for filtering.
     *
     * @param Filter|array{
     *   operator: value-of<Operator>, path: string, value: string
     * } $filter
     */
    public function withFilter(Filter|array $filter): self
    {
        $obj = clone $this;
        $obj['filter'] = $filter;

        return $obj;
    }

    /**
     * The name of the audience.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

        return $obj;
    }
}
