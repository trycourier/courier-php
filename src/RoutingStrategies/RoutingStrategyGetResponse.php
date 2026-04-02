<?php

declare(strict_types=1);

namespace Courier\RoutingStrategies;

use Courier\Channel;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageProvidersType;
use Courier\MessageRouting;

/**
 * Full routing strategy entity returned by GET.
 *
 * @phpstan-import-type ChannelShape from \Courier\Channel
 * @phpstan-import-type MessageProvidersTypeShape from \Courier\MessageProvidersType
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 *
 * @phpstan-type RoutingStrategyGetResponseShape = array{
 *   id: string,
 *   channels: array<string,Channel|ChannelShape>,
 *   created: int,
 *   creator: string,
 *   name: string,
 *   providers: array<string,MessageProvidersType|MessageProvidersTypeShape>,
 *   routing: MessageRouting|MessageRoutingShape,
 *   description?: string|null,
 *   tags?: list<string>|null,
 *   updated?: int|null,
 *   updater?: string|null,
 * }
 */
final class RoutingStrategyGetResponse implements BaseModel
{
    /** @use SdkModel<RoutingStrategyGetResponseShape> */
    use SdkModel;

    /**
     * The routing strategy ID (rs_ prefix).
     */
    #[Required]
    public string $id;

    /**
     * Per-channel delivery configuration. May be empty.
     *
     * @var array<string,Channel> $channels
     */
    #[Required(map: Channel::class)]
    public array $channels;

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
     * Per-provider delivery configuration. May be empty.
     *
     * @var array<string,MessageProvidersType> $providers
     */
    #[Required(map: MessageProvidersType::class)]
    public array $providers;

    /**
     * Routing tree defining channel selection method and order.
     */
    #[Required]
    public MessageRouting $routing;

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
     * `new RoutingStrategyGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingStrategyGetResponse::with(
     *   id: ...,
     *   channels: ...,
     *   created: ...,
     *   creator: ...,
     *   name: ...,
     *   providers: ...,
     *   routing: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingStrategyGetResponse)
     *   ->withID(...)
     *   ->withChannels(...)
     *   ->withCreated(...)
     *   ->withCreator(...)
     *   ->withName(...)
     *   ->withProviders(...)
     *   ->withRouting(...)
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
     * @param array<string,Channel|ChannelShape> $channels
     * @param array<string,MessageProvidersType|MessageProvidersTypeShape> $providers
     * @param MessageRouting|MessageRoutingShape $routing
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        array $channels,
        int $created,
        string $creator,
        string $name,
        array $providers,
        MessageRouting|array $routing,
        ?string $description = null,
        ?array $tags = null,
        ?int $updated = null,
        ?string $updater = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['channels'] = $channels;
        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['name'] = $name;
        $self['providers'] = $providers;
        $self['routing'] = $routing;

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
     * Per-channel delivery configuration. May be empty.
     *
     * @param array<string,Channel|ChannelShape> $channels
     */
    public function withChannels(array $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

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
     * Per-provider delivery configuration. May be empty.
     *
     * @param array<string,MessageProvidersType|MessageProvidersTypeShape> $providers
     */
    public function withProviders(array $providers): self
    {
        $self = clone $this;
        $self['providers'] = $providers;

        return $self;
    }

    /**
     * Routing tree defining channel selection method and order.
     *
     * @param MessageRouting|MessageRoutingShape $routing
     */
    public function withRouting(MessageRouting|array $routing): self
    {
        $self = clone $this;
        $self['routing'] = $routing;

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
