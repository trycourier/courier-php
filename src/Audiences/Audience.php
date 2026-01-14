<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\AudienceFilterConfig;
use Courier\Audiences\Audience\Operator;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AudienceFilterConfigShape from \Courier\AudienceFilterConfig
 *
 * @phpstan-type AudienceShape = array{
 *   id: string,
 *   createdAt: string,
 *   description: string,
 *   name: string,
 *   updatedAt: string,
 *   filter?: null|AudienceFilterConfig|AudienceFilterConfigShape,
 *   operator?: null|Operator|value-of<Operator>,
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
     * The name of the audience.
     */
    #[Required]
    public string $name;

    #[Required('updated_at')]
    public string $updatedAt;

    /**
     * Filter configuration for audience membership containing an array of filter rules.
     */
    #[Optional(nullable: true)]
    public ?AudienceFilterConfig $filter;

    /**
     * The logical operator (AND/OR) for the top-level filter.
     *
     * @var value-of<Operator>|null $operator
     */
    #[Optional(enum: Operator::class)]
    public ?string $operator;

    /**
     * `new Audience()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Audience::with(
     *   id: ..., createdAt: ..., description: ..., name: ..., updatedAt: ...
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
     * @param AudienceFilterConfig|AudienceFilterConfigShape|null $filter
     * @param Operator|value-of<Operator>|null $operator
     */
    public static function with(
        string $id,
        string $createdAt,
        string $description,
        string $name,
        string $updatedAt,
        AudienceFilterConfig|array|null $filter = null,
        Operator|string|null $operator = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['name'] = $name;
        $self['updatedAt'] = $updatedAt;

        null !== $filter && $self['filter'] = $filter;
        null !== $operator && $self['operator'] = $operator;

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

    /**
     * Filter configuration for audience membership containing an array of filter rules.
     *
     * @param AudienceFilterConfig|AudienceFilterConfigShape|null $filter
     */
    public function withFilter(AudienceFilterConfig|array|null $filter): self
    {
        $self = clone $this;
        $self['filter'] = $filter;

        return $self;
    }

    /**
     * The logical operator (AND/OR) for the top-level filter.
     *
     * @param Operator|value-of<Operator> $operator
     */
    public function withOperator(Operator|string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }
}
