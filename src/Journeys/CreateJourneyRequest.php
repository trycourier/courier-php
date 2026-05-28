<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for creating a journey.
 *
 * @phpstan-type CreateJourneyRequestShape = array{
 *   name: string,
 *   nodes: list<mixed>,
 *   enabled?: bool|null,
 *   state?: null|JourneyState|value-of<JourneyState>,
 * }
 */
final class CreateJourneyRequest implements BaseModel
{
    /** @use SdkModel<CreateJourneyRequestShape> */
    use SdkModel;

    #[Required]
    public string $name;

    /** @var list<mixed> $nodes */
    #[Required(list: JourneyNode::class)]
    public array $nodes;

    #[Optional]
    public ?bool $enabled;

    /**
     * Lifecycle state of a journey.
     *
     * @var value-of<JourneyState>|null $state
     */
    #[Optional(enum: JourneyState::class)]
    public ?string $state;

    /**
     * `new CreateJourneyRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreateJourneyRequest::with(name: ..., nodes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreateJourneyRequest)->withName(...)->withNodes(...)
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
     * @param list<mixed> $nodes
     * @param JourneyState|value-of<JourneyState>|null $state
     */
    public static function with(
        string $name,
        array $nodes,
        ?bool $enabled = null,
        JourneyState|string|null $state = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['nodes'] = $nodes;

        null !== $enabled && $self['enabled'] = $enabled;
        null !== $state && $self['state'] = $state;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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

    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * Lifecycle state of a journey.
     *
     * @param JourneyState|value-of<JourneyState> $state
     */
    public function withState(JourneyState|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
