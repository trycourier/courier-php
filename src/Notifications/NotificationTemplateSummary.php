<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationTemplateSummary\State;

/**
 * V2 (CDS) template summary returned in list responses.
 *
 * @phpstan-type NotificationTemplateSummaryShape = array{
 *   id: string,
 *   created: int,
 *   creator: string,
 *   name: string,
 *   state: State|value-of<State>,
 *   tags: list<string>,
 *   updated?: int|null,
 *   updater?: string|null,
 * }
 */
final class NotificationTemplateSummary implements BaseModel
{
    /** @use SdkModel<NotificationTemplateSummaryShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * Epoch milliseconds when the template was created.
     */
    #[Required]
    public int $created;

    /**
     * User ID of the creator.
     */
    #[Required]
    public string $creator;

    #[Required]
    public string $name;

    /** @var value-of<State> $state */
    #[Required(enum: State::class)]
    public string $state;

    /** @var list<string> $tags */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * Epoch milliseconds of last update.
     */
    #[Optional]
    public ?int $updated;

    /**
     * User ID of the last updater.
     */
    #[Optional]
    public ?string $updater;

    /**
     * `new NotificationTemplateSummary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplateSummary::with(
     *   id: ..., created: ..., creator: ..., name: ..., state: ..., tags: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationTemplateSummary)
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
     * @param State|value-of<State> $state
     * @param list<string> $tags
     */
    public static function with(
        string $id,
        int $created,
        string $creator,
        string $name,
        State|string $state,
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

    /**
     * Epoch milliseconds when the template was created.
     */
    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * User ID of the creator.
     */
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

    /**
     * @param State|value-of<State> $state
     */
    public function withState(State|string $state): self
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

    /**
     * Epoch milliseconds of last update.
     */
    public function withUpdated(int $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    /**
     * User ID of the last updater.
     */
    public function withUpdater(string $updater): self
    {
        $self = clone $this;
        $self['updater'] = $updater;

        return $self;
    }
}
