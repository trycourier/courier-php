<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Replace the journey draft. Updates the working draft only; call POST /journeys/{templateId}/publish to make it live.
 *
 * @see Courier\Services\JourneysService::replace()
 *
 * @phpstan-type JourneyReplaceParamsShape = array{
 *   name: string,
 *   nodes: list<mixed>,
 *   enabled?: bool|null,
 *   state?: null|JourneyState|value-of<JourneyState>,
 * }
 */
final class JourneyReplaceParams implements BaseModel
{
    /** @use SdkModel<JourneyReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $name;

    /** @var list<mixed> $nodes */
    #[Required(list: JourneyNode::class)]
    public array $nodes;

    #[Optional]
    public ?bool $enabled;

    /** @var value-of<JourneyState>|null $state */
    #[Optional(enum: JourneyState::class)]
    public ?string $state;

    /**
     * `new JourneyReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyReplaceParams::with(name: ..., nodes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyReplaceParams)->withName(...)->withNodes(...)
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
     * @param JourneyState|value-of<JourneyState> $state
     */
    public function withState(JourneyState|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
