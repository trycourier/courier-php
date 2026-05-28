<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyNode;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyNode\JourneyBranchNode\Default_;
use Courier\Journeys\JourneyNode\JourneyBranchNode\Path;
use Courier\Journeys\JourneyNode\JourneyBranchNode\Type;

/**
 * Branch node. Routes to the first entry in `paths[]` whose `conditions` match, else falls through to `default.nodes`.
 *
 * @phpstan-import-type DefaultShape from \Courier\Journeys\JourneyNode\JourneyBranchNode\Default_
 *
 * @phpstan-type JourneyBranchNodeShape = array{
 *   default: Default_|DefaultShape,
 *   paths: list<mixed>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 * }
 */
final class JourneyBranchNode implements BaseModel
{
    /** @use SdkModel<JourneyBranchNodeShape> */
    use SdkModel;

    #[Required]
    public Default_ $default;

    /** @var list<mixed> $paths */
    #[Required(list: Path::class)]
    public array $paths;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional]
    public ?string $id;

    /**
     * `new JourneyBranchNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyBranchNode::with(default: ..., paths: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyBranchNode)->withDefault(...)->withPaths(...)->withType(...)
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
     * @param Default_|DefaultShape $default
     * @param list<mixed> $paths
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Default_|array $default,
        array $paths,
        Type|string $type,
        ?string $id = null
    ): self {
        $self = new self;

        $self['default'] = $default;
        $self['paths'] = $paths;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;

        return $self;
    }

    /**
     * @param Default_|DefaultShape $default
     */
    public function withDefault(Default_|array $default): self
    {
        $self = clone $this;
        $self['default'] = $default;

        return $self;
    }

    /**
     * @param list<mixed> $paths
     */
    public function withPaths(array $paths): self
    {
        $self = clone $this;
        $self['paths'] = $paths;

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
}
