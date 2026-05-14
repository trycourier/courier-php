<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyAINode\Type;

/**
 * @phpstan-import-type JourneyConditionsFieldVariants from \Courier\Journeys\JourneyConditionsField
 * @phpstan-import-type JourneyConditionsFieldShape from \Courier\Journeys\JourneyConditionsField
 *
 * @phpstan-type JourneyAINodeShape = array{
 *   outputSchema: array<string,mixed>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   conditions?: JourneyConditionsFieldShape|null,
 *   model?: string|null,
 *   userPrompt?: string|null,
 *   webSearch?: bool|null,
 * }
 */
final class JourneyAINode implements BaseModel
{
    /** @use SdkModel<JourneyAINodeShape> */
    use SdkModel;

    /**
     * A JSONSchema object (Draft-07-compatible). Validated at runtime by Ajv.
     *
     * @var array<string,mixed> $outputSchema
     */
    #[Required('output_schema', map: 'mixed')]
    public array $outputSchema;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional]
    public ?string $id;

    /**
     * Condition spec for a journey node. Accepts a single condition atom, an AND/OR group, or an AND/OR nested group. Omit the `conditions` property entirely to express "no conditions".
     *
     * @var JourneyConditionsFieldVariants|null $conditions
     */
    #[Optional(union: JourneyConditionsField::class)]
    public array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions;

    #[Optional]
    public ?string $model;

    #[Optional('user_prompt')]
    public ?string $userPrompt;

    #[Optional('web_search')]
    public ?bool $webSearch;

    /**
     * `new JourneyAINode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyAINode::with(outputSchema: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyAINode)->withOutputSchema(...)->withType(...)
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
     * @param array<string,mixed> $outputSchema
     * @param Type|value-of<Type> $type
     * @param JourneyConditionsFieldShape|null $conditions
     */
    public static function with(
        array $outputSchema,
        Type|string $type,
        ?string $id = null,
        array|JourneyConditionGroup|JourneyConditionNestedGroup|null $conditions = null,
        ?string $model = null,
        ?string $userPrompt = null,
        ?bool $webSearch = null,
    ): self {
        $self = new self;

        $self['outputSchema'] = $outputSchema;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $conditions && $self['conditions'] = $conditions;
        null !== $model && $self['model'] = $model;
        null !== $userPrompt && $self['userPrompt'] = $userPrompt;
        null !== $webSearch && $self['webSearch'] = $webSearch;

        return $self;
    }

    /**
     * A JSONSchema object (Draft-07-compatible). Validated at runtime by Ajv.
     *
     * @param array<string,mixed> $outputSchema
     */
    public function withOutputSchema(array $outputSchema): self
    {
        $self = clone $this;
        $self['outputSchema'] = $outputSchema;

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

    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    public function withUserPrompt(string $userPrompt): self
    {
        $self = clone $this;
        $self['userPrompt'] = $userPrompt;

        return $self;
    }

    public function withWebSearch(bool $webSearch): self
    {
        $self = clone $this;
        $self['webSearch'] = $webSearch;

        return $self;
    }
}
