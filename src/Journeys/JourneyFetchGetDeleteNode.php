<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyFetchGetDeleteNode\Method;
use Courier\Journeys\JourneyFetchGetDeleteNode\Type;

/**
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyFetchGetDeleteNodeShape = array{
 *   mergeStrategy: JourneyMergeStrategy|value-of<JourneyMergeStrategy>,
 *   method: Method|value-of<Method>,
 *   type: Type|value-of<Type>,
 *   url: string,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 *   headers?: array<string,string>|null,
 *   queryParams?: array<string,string>|null,
 *   responseSchema?: array<string,mixed>|null,
 * }
 */
final class JourneyFetchGetDeleteNode implements BaseModel
{
    /** @use SdkModel<JourneyFetchGetDeleteNodeShape> */
    use SdkModel;

    /** @var value-of<JourneyMergeStrategy> $mergeStrategy */
    #[Required('merge_strategy', enum: JourneyMergeStrategy::class)]
    public string $mergeStrategy;

    /** @var value-of<Method> $method */
    #[Required(enum: Method::class)]
    public string $method;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required]
    public string $url;

    #[Optional]
    public ?string $id;

    /**
     * Condition spec for a journey node. Accepts a single condition atom, an AND/OR group, or an AND/OR nested group. Omit the `conditions` property entirely to express "no conditions".
     *
     * @var JourneyConditionsFieldVariants|null $conditions
     */
    #[Optional(union: JourneyConditionsField::class)]
    public array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions;

    /** @var array<string,string>|null $headers */
    #[Optional(map: 'string')]
    public ?array $headers;

    /** @var array<string,string>|null $queryParams */
    #[Optional('query_params', map: 'string')]
    public ?array $queryParams;

    /**
     * A JSONSchema object (Draft-07-compatible). Validated at runtime by Ajv.
     *
     * @var array<string,mixed>|null $responseSchema
     */
    #[Optional('response_schema', map: 'mixed')]
    public ?array $responseSchema;

    /**
     * `new JourneyFetchGetDeleteNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyFetchGetDeleteNode::with(
     *   mergeStrategy: ..., method: ..., type: ..., url: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyFetchGetDeleteNode)
     *   ->withMergeStrategy(...)
     *   ->withMethod(...)
     *   ->withType(...)
     *   ->withURL(...)
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
     * @param JourneyMergeStrategy|value-of<JourneyMergeStrategy> $mergeStrategy
     * @param Method|value-of<Method> $method
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     * @param array<string,string>|null $headers
     * @param array<string,string>|null $queryParams
     * @param array<string,mixed>|null $responseSchema
     */
    public static function with(
        JourneyMergeStrategy|string $mergeStrategy,
        Method|string $method,
        Type|string $type,
        string $url,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
        ?array $headers = null,
        ?array $queryParams = null,
        ?array $responseSchema = null,
    ): self {
        $self = new self;

        $self['mergeStrategy'] = $mergeStrategy;
        $self['method'] = $method;
        $self['type'] = $type;
        $self['url'] = $url;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;
        null !== $headers && $self['headers'] = $headers;
        null !== $queryParams && $self['queryParams'] = $queryParams;
        null !== $responseSchema && $self['responseSchema'] = $responseSchema;

        return $self;
    }

    /**
     * @param JourneyMergeStrategy|value-of<JourneyMergeStrategy> $mergeStrategy
     */
    public function withMergeStrategy(
        JourneyMergeStrategy|string $mergeStrategy
    ): self {
        $self = clone $this;
        $self['mergeStrategy'] = $mergeStrategy;

        return $self;
    }

    /**
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

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

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * @param array<string,string> $headers
     */
    public function withHeaders(array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }

    /**
     * @param array<string,string> $queryParams
     */
    public function withQueryParams(array $queryParams): self
    {
        $self = clone $this;
        $self['queryParams'] = $queryParams;

        return $self;
    }

    /**
     * A JSONSchema object (Draft-07-compatible). Validated at runtime by Ajv.
     *
     * @param array<string,mixed> $responseSchema
     */
    public function withResponseSchema(array $responseSchema): self
    {
        $self = clone $this;
        $self['responseSchema'] = $responseSchema;

        return $self;
    }
}
