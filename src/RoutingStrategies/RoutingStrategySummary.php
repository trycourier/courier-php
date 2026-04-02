<?php

declare(strict_types=1);

namespace Courier\RoutingStrategies;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Routing strategy metadata returned in list responses. Does not include routing/channels/providers content.
 *
 * @phpstan-type RoutingStrategySummaryShape = array{
 *   id: string,
 *   created: int,
 *   creator: string,
 *   name: string,
 *   description?: string|null,
 *   tags?: list<string>|null,
 *   updated?: int|null,
 *   updater?: string|null,
 * }
 */
final class RoutingStrategySummary implements BaseModel
{
    /** @use SdkModel<RoutingStrategySummaryShape> */
    use SdkModel;

    /**
     * The routing strategy ID (rs_ prefix).
     */
    #[Required]
    public string $id;

    /**
     * Epoch milliseconds when the strategy was created.
     */
    #[Required]
    public int $created;

    /**
     * User ID of the creator.
     */
    #[Required]
    public string $creator;

    /**
     * Human-readable name.
     */
    #[Required]
    public string $name;

    /**
     * Description of the routing strategy.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Tags for categorization.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $tags;

    /**
     * Epoch milliseconds of last update.
     */
    #[Optional(nullable: true)]
    public ?int $updated;

    /**
     * User ID of the last updater.
     */
    #[Optional(nullable: true)]
    public ?string $updater;

    /**
     * `new RoutingStrategySummary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingStrategySummary::with(id: ..., created: ..., creator: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingStrategySummary)
     *   ->withID(...)
     *   ->withCreated(...)
     *   ->withCreator(...)
     *   ->withName(...)
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
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        int $created,
        string $creator,
        string $name,
        ?string $description = null,
        ?array $tags = null,
        ?int $updated = null,
        ?string $updater = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $tags && $self['tags'] = $tags;
        null !== $updated && $self['updated'] = $updated;
        null !== $updater && $self['updater'] = $updater;

        return $self;
    }

    /**
     * The routing strategy ID (rs_ prefix).
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Epoch milliseconds when the strategy was created.
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

    /**
     * Human-readable name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Description of the routing strategy.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Tags for categorization.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Epoch milliseconds of last update.
     */
    public function withUpdated(?int $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    /**
     * User ID of the last updater.
     */
    public function withUpdater(?string $updater): self
    {
        $self = clone $this;
        $self['updater'] = $updater;

        return $self;
    }
}
