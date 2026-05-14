<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyNode\JourneyBranchNode;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyConditionGroup;
use Courier\Journeys\JourneyConditionNestedGroup;
use Courier\Journeys\JourneyConditionsField;
use Courier\Journeys\JourneyNode;

/**
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type PathShape = array{
 *   conditions: JourneyConditionsFieldShape,
 *   nodes: list<mixed>,
 *   label?: string|null,
 * }
 */
final class Path implements BaseModel
{
    /** @use SdkModel<PathShape> */
    use SdkModel;

    /**
     * Condition spec for a journey node. Accepts a single condition atom, an AND/OR group, or an AND/OR nested group. Omit the `conditions` property entirely to express "no conditions".
     *
     * @var JourneyConditionsFieldVariants $conditions
     */
    #[Required(union: JourneyConditionsField::class)]
    public array|JourneyConditionGroup|JourneyConditionNestedGroup $conditions;

    /** @var list<mixed> $nodes */
    #[Required(list: JourneyNode::class)]
    public array $nodes;

    #[Optional]
    public ?string $label;

    /**
     * `new Path()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Path::with(conditions: ..., nodes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Path)->withConditions(...)->withNodes(...)
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
     * @param JourneyConditionsFieldShape $conditions
     * @param list<mixed> $nodes
     */
    public static function with(
        array|JourneyConditionGroup|JourneyConditionNestedGroup $conditions,
        array $nodes,
        ?string $label = null,
    ): self {
        $self = new self;

        $self['conditions'] = $conditions;
        $self['nodes'] = $nodes;

        null !== $label && $self['label'] = $label;

        return $self;
    }

    /**
     * Condition spec for a journey node. Accepts a single condition atom, an AND/OR group, or an AND/OR nested group. Omit the `conditions` property entirely to express "no conditions".
     *
     * @param JourneyConditionsFieldShape $conditions
     */
    public function withConditions(
        array|JourneyConditionGroup|JourneyConditionNestedGroup $conditions
    ): self {
        $self = clone $this;
        $self['conditions'] = $conditions;

        return $self;
    }

    /**
     * @param list<mixed> $nodes
     */
    public function withNodes(array $nodes): self
    {
        $self = clone $this;
        $self['nodes'] = $nodes;

        return $self;
    }

    public function withLabel(string $label): self
    {
        $self = clone $this;
        $self['label'] = $label;

        return $self;
    }
}
