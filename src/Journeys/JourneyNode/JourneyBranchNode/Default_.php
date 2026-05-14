<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyNode\JourneyBranchNode;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyNode;

/**
 * @phpstan-type DefaultShape = array{nodes: list<mixed>, label?: string|null}
 */
final class Default_ implements BaseModel
{
    /** @use SdkModel<DefaultShape> */
    use SdkModel;

    /** @var list<mixed> $nodes */
    #[Required(list: JourneyNode::class)]
    public array $nodes;

    #[Optional]
    public ?string $label;

    /**
     * `new Default_()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Default_::with(nodes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Default_)->withNodes(...)
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
     */
    public static function with(array $nodes, ?string $label = null): self
    {
        $self = new self;

        $self['nodes'] = $nodes;

        null !== $label && $self['label'] = $label;

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
