<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type JourneyTemplateSummaryShape = array{
 *   id: string,
 *   created: int,
 *   creator: string,
 *   name: string,
 *   state: string,
 *   tags: list<string>,
 *   updated?: int|null,
 *   updater?: string|null,
 * }
 */
final class JourneyTemplateSummary implements BaseModel
{
    /** @use SdkModel<JourneyTemplateSummaryShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $created;

    #[Required]
    public string $creator;

    #[Required]
    public string $name;

    #[Required]
    public string $state;

    /** @var list<string> $tags */
    #[Required(list: 'string')]
    public array $tags;

    #[Optional]
    public ?int $updated;

    #[Optional]
    public ?string $updater;

    /**
     * `new JourneyTemplateSummary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyTemplateSummary::with(
     *   id: ..., created: ..., creator: ..., name: ..., state: ..., tags: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyTemplateSummary)
     *   ->withID(...)
     *   ->withCreated(...)
     *   ->withCreator(...)
     *   ->withName(...)
     *   ->withState(...)
     *   ->withTags(...)
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
     * @param list<string> $tags
     */
    public static function with(
        string $id,
        int $created,
        string $creator,
        string $name,
        string $state,
        array $tags,
        ?int $updated = null,
        ?string $updater = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['name'] = $name;
        $self['state'] = $state;
        $self['tags'] = $tags;

        null !== $updated && $self['updated'] = $updated;
        null !== $updater && $self['updater'] = $updater;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    public function withCreator(string $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    public function withUpdated(int $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    public function withUpdater(string $updater): self
    {
        $self = clone $this;
        $self['updater'] = $updater;

        return $self;
    }
}
