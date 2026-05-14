<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type JourneyResponseShape = array{
 *   id: string,
 *   created: int|null,
 *   creator: string|null,
 *   enabled: bool,
 *   name: string,
 *   nodes: list<mixed>,
 *   published: int|null,
 *   state: JourneyState|value-of<JourneyState>,
 *   updated: int|null,
 *   updater: string|null,
 * }
 */
final class JourneyResponse implements BaseModel
{
    /** @use SdkModel<JourneyResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public ?int $created;

    #[Required]
    public ?string $creator;

    #[Required]
    public bool $enabled;

    #[Required]
    public string $name;

    /** @var list<mixed> $nodes */
    #[Required(list: JourneyNode::class)]
    public array $nodes;

    #[Required]
    public ?int $published;

    /** @var value-of<JourneyState> $state */
    #[Required(enum: JourneyState::class)]
    public string $state;

    #[Required]
    public ?int $updated;

    #[Required]
    public ?string $updater;

    /**
     * `new JourneyResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyResponse::with(
     *   id: ...,
     *   created: ...,
     *   creator: ...,
     *   enabled: ...,
     *   name: ...,
     *   nodes: ...,
     *   published: ...,
     *   state: ...,
     *   updated: ...,
     *   updater: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyResponse)
     *   ->withID(...)
     *   ->withCreated(...)
     *   ->withCreator(...)
     *   ->withEnabled(...)
     *   ->withName(...)
     *   ->withNodes(...)
     *   ->withPublished(...)
     *   ->withState(...)
     *   ->withUpdated(...)
     *   ->withUpdater(...)
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
     * @param JourneyState|value-of<JourneyState> $state
     */
    public static function with(
        string $id,
        ?int $created,
        ?string $creator,
        bool $enabled,
        string $name,
        array $nodes,
        ?int $published,
        JourneyState|string $state,
        ?int $updated,
        ?string $updater,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['enabled'] = $enabled;
        $self['name'] = $name;
        $self['nodes'] = $nodes;
        $self['published'] = $published;
        $self['state'] = $state;
        $self['updated'] = $updated;
        $self['updater'] = $updater;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreated(?int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    public function withCreator(?string $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

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

    public function withPublished(?int $published): self
    {
        $self = clone $this;
        $self['published'] = $published;

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

    public function withUpdated(?int $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    public function withUpdater(?string $updater): self
    {
        $self = clone $this;
        $self['updater'] = $updater;

        return $self;
    }
}
