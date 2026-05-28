<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Create a journey. Defaults to `DRAFT` state; pass `state: "PUBLISHED"` to publish on create. Send nodes are not allowed on `POST`. The standard flow is: create the journey shell here, add notification templates with `POST /journeys/{templateId}/templates`, then wire them into the journey with `PUT /journeys/{templateId}`. Call `POST /journeys/{templateId}/publish` to publish a draft after the fact.
 *
 * @see Courier\Services\JourneysService::create()
 *
 * @phpstan-type JourneyCreateParamsShape = array{
 *   name: string,
 *   nodes: list<mixed>,
 *   enabled?: bool|null,
 *   state?: null|JourneyState|value-of<JourneyState>,
 * }
 */
final class JourneyCreateParams implements BaseModel
{
    /** @use SdkModel<JourneyCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new JourneyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyCreateParams::with(name: ..., nodes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyCreateParams)->withName(...)->withNodes(...)
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
