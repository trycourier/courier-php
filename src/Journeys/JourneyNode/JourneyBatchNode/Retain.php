<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyNode\JourneyBatchNode;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyNode\JourneyBatchNode\Retain\Type;

/**
 * How to select which collected events to retain in the aggregated payload when the batch releases.
 *
 * @phpstan-type RetainShape = array{
 *   count: int,
 *   type: \Courier\Journeys\JourneyNode\JourneyBatchNode\Retain\Type|value-of<\Courier\Journeys\JourneyNode\JourneyBatchNode\Retain\Type>,
 *   sortKey?: string|null,
 * }
 */
final class Retain implements BaseModel
{
    /** @use SdkModel<RetainShape> */
    use SdkModel;

    #[Required]
    public int $count;

    /** @var value-of<Type> $type */
    #[Required(
        enum: Type::class
    )]
    public string $type;

    /**
     * Dot-path into the event payload (e.g. `data.priority`). Required when `type` is `highest` or `lowest`.
     */
    #[Optional('sort_key')]
    public ?string $sortKey;

    /**
     * `new Retain()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Retain::with(count: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Retain)->withCount(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        int $count,
        Type|string $type,
        ?string $sortKey = null,
    ): self {
        $self = new self;

        $self['count'] = $count;
        $self['type'] = $type;

        null !== $sortKey && $self['sortKey'] = $sortKey;

        return $self;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(
        Type|string $type
    ): self {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Dot-path into the event payload (e.g. `data.priority`). Required when `type` is `highest` or `lowest`.
     */
    public function withSortKey(string $sortKey): self
    {
        $self = clone $this;
        $self['sortKey'] = $sortKey;

        return $self;
    }
}
