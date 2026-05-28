<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyNode;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyConditionGroup;
use Courier\Journeys\JourneyConditionNestedGroup;
use Courier\Journeys\JourneyConditionsField;
use Courier\Journeys\JourneyNode\JourneyBatchNode\Retain;
use Courier\Journeys\JourneyNode\JourneyBatchNode\Scope;
use Courier\Journeys\JourneyNode\JourneyBatchNode\Type;

/**
 * Collect events arriving at the node into a single batch and fire one downstream step with the aggregated payload. The first event into a batch owns the run; later contributing events terminate at the batch step. The batch releases when any of `max_items` is reached, a quiet window of `wait_period` elapses, or the `max_wait_period` ceiling hits.
 *
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type RetainShape from \Courier\Journeys\JourneyNode\JourneyBatchNode\Retain
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyBatchNodeShape = array{
 *   maxWaitPeriod: string,
 *   retain: Retain|RetainShape,
 *   scope: Scope|value-of<Scope>,
 *   type: Type|value-of<Type>,
 *   waitPeriod: string,
 *   id?: string|null,
 *   categoryKey?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 *   maxItems?: int|null,
 * }
 */
final class JourneyBatchNode implements BaseModel
{
    /** @use SdkModel<JourneyBatchNodeShape> */
    use SdkModel;

    /**
     * ISO 8601 duration. Hard ceiling from the first event into the batch; releases the batch unconditionally when it elapses.
     */
    #[Required('max_wait_period')]
    public string $maxWaitPeriod;

    /**
     * How to select which collected events to retain in the aggregated payload when the batch releases.
     */
    #[Required]
    public Retain $retain;

    /** @var value-of<Scope> $scope */
    #[Required(enum: Scope::class)]
    public string $scope;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * ISO 8601 duration. Quiet window that releases the batch when it elapses with no new contributing events. Must be less than `max_wait_period`.
     */
    #[Required('wait_period')]
    public string $waitPeriod;

    #[Optional]
    public ?string $id;

    /**
     * Optional partition key. Events with the same `category_key` are batched together; events with different values are batched separately.
     */
    #[Optional('category_key')]
    public ?string $categoryKey;

    /**
     * Condition spec for a journey node. Accepts a single condition atom, an AND/OR group, or an AND/OR nested group. Omit the `conditions` property entirely to express "no conditions".
     *
     * @var JourneyConditionsFieldVariants|null $conditions
     */
    #[Optional(union: JourneyConditionsField::class)]
    public array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions;

    /**
     * Releases the batch once this many events have been collected.
     */
    #[Optional('max_items')]
    public ?int $maxItems;

    /**
     * `new JourneyBatchNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyBatchNode::with(
     *   maxWaitPeriod: ..., retain: ..., scope: ..., type: ..., waitPeriod: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyBatchNode)
     *   ->withMaxWaitPeriod(...)
     *   ->withRetain(...)
     *   ->withScope(...)
     *   ->withType(...)
     *   ->withWaitPeriod(...)
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
     * @param Retain|RetainShape $retain
     * @param Scope|value-of<Scope> $scope
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     */
    public static function with(
        string $maxWaitPeriod,
        Retain|array $retain,
        Scope|string $scope,
        Type|string $type,
        string $waitPeriod,
        ?string $id = null,
        ?string $categoryKey = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
        ?int $maxItems = null,
    ): self {
        $self = new self;

        $self['maxWaitPeriod'] = $maxWaitPeriod;
        $self['retain'] = $retain;
        $self['scope'] = $scope;
        $self['type'] = $type;
        $self['waitPeriod'] = $waitPeriod;

        null !== $id && $self['id'] = $id;
        null !== $categoryKey && $self['categoryKey'] = $categoryKey;
        null !== $conditions && $self['conditions'] = $conditions;
        null !== $maxItems && $self['maxItems'] = $maxItems;

        return $self;
    }

    /**
     * ISO 8601 duration. Hard ceiling from the first event into the batch; releases the batch unconditionally when it elapses.
     */
    public function withMaxWaitPeriod(string $maxWaitPeriod): self
    {
        $self = clone $this;
        $self['maxWaitPeriod'] = $maxWaitPeriod;

        return $self;
    }

    /**
     * How to select which collected events to retain in the aggregated payload when the batch releases.
     *
     * @param Retain|RetainShape $retain
     */
    public function withRetain(Retain|array $retain): self
    {
        $self = clone $this;
        $self['retain'] = $retain;

        return $self;
    }

    /**
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * ISO 8601 duration. Quiet window that releases the batch when it elapses with no new contributing events. Must be less than `max_wait_period`.
     */
    public function withWaitPeriod(string $waitPeriod): self
    {
        $self = clone $this;
        $self['waitPeriod'] = $waitPeriod;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Optional partition key. Events with the same `category_key` are batched together; events with different values are batched separately.
     */
    public function withCategoryKey(string $categoryKey): self
    {
        $self = clone $this;
        $self['categoryKey'] = $categoryKey;

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
     * Releases the batch once this many events have been collected.
     */
    public function withMaxItems(int $maxItems): self
    {
        $self = clone $this;
        $self['maxItems'] = $maxItems;

        return $self;
    }
}
