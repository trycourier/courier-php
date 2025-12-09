<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\Filter\Operator;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AudienceShape = array{
 *   id: string,
 *   createdAt: string,
 *   description: string,
 *   filter: Filter,
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
     * @param Filter|array{
     *   operator: value-of<Operator>, path: string, value: string
     * } $filter
     */
    public static function with(
        string $id,
        string $createdAt,
        string $description,
        Filter|array $filter,
        string $name,
        string $updatedAt,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['createdAt'] = $createdAt;
        $obj['description'] = $description;
        $obj['filter'] = $filter;
        $obj['name'] = $name;
        $obj['updatedAt'] = $updatedAt;

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
        $obj['createdAt'] = $createdAt;

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
        $obj['updatedAt'] = $updatedAt;

        return $obj;
    }
}
