<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyTemplateGetResponse\Brand;
use Courier\Journeys\JourneyTemplateGetResponse\Content;
use Courier\Journeys\JourneyTemplateGetResponse\State;
use Courier\Journeys\JourneyTemplateGetResponse\Subscription;

/**
 * @phpstan-import-type BrandShape from \Courier\Journeys\JourneyTemplateGetResponse\Brand
 * @phpstan-import-type ContentShape from \Courier\Journeys\JourneyTemplateGetResponse\Content
 * @phpstan-import-type SubscriptionShape from \Courier\Journeys\JourneyTemplateGetResponse\Subscription
 *
 * @phpstan-type JourneyTemplateGetResponseShape = array{
 *   id: string,
 *   brand: null|Brand|BrandShape,
 *   content: Content|ContentShape,
 *   created: int,
 *   creator: string,
 *   name: string,
 *   state: State|value-of<State>,
 *   subscription: null|Subscription|SubscriptionShape,
 *   tags: list<string>,
 *   updated?: int|null,
 *   updater?: string|null,
 * }
 */
final class JourneyTemplateGetResponse implements BaseModel
{
    /** @use SdkModel<JourneyTemplateGetResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public ?Brand $brand;

    #[Required]
    public Content $content;

    #[Required]
    public int $created;

    #[Required]
    public string $creator;

    #[Required]
    public string $name;

    /** @var value-of<State> $state */
    #[Required(enum: State::class)]
    public string $state;

    #[Required]
    public ?Subscription $subscription;

    /** @var list<string> $tags */
    #[Required(list: 'string')]
    public array $tags;

    #[Optional]
    public ?int $updated;

    #[Optional]
    public ?string $updater;

    /**
     * `new JourneyTemplateGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyTemplateGetResponse::with(
     *   id: ...,
     *   brand: ...,
     *   content: ...,
     *   created: ...,
     *   creator: ...,
     *   name: ...,
     *   state: ...,
     *   subscription: ...,
     *   tags: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyTemplateGetResponse)
     *   ->withID(...)
     *   ->withBrand(...)
     *   ->withContent(...)
     *   ->withCreated(...)
     *   ->withCreator(...)
     *   ->withName(...)
     *   ->withState(...)
     *   ->withSubscription(...)
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
     * @param Brand|BrandShape|null $brand
     * @param Content|ContentShape $content
     * @param Subscription|SubscriptionShape|null $subscription
     * @param list<string> $tags
     * @param State|value-of<State> $state
     */
    public static function with(
        string $id,
        Brand|array|null $brand,
        Content|array $content,
        int $created,
        string $creator,
        string $name,
        Subscription|array|null $subscription,
        array $tags,
        State|string $state = 'DRAFT',
        ?int $updated = null,
        ?string $updater = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['brand'] = $brand;
        $self['content'] = $content;
        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['name'] = $name;
        $self['state'] = $state;
        $self['subscription'] = $subscription;
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
     * @param Brand|BrandShape|null $brand
     */
    public function withBrand(Brand|array|null $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

        return $self;
    }

    /**
     * @param Content|ContentShape $content
     */
    public function withContent(Content|array $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

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
     * @param Subscription|SubscriptionShape|null $subscription
     */
    public function withSubscription(
        Subscription|array|null $subscription
    ): self {
        $self = clone $this;
        $self['subscription'] = $subscription;

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
