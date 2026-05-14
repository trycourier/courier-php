<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyTemplateReplaceRequest;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneyTemplateReplaceRequest\Notification\Brand;
use Courier\Journeys\JourneyTemplateReplaceRequest\Notification\Content;
use Courier\Journeys\JourneyTemplateReplaceRequest\Notification\Subscription;

/**
 * @phpstan-import-type BrandShape from \Courier\Journeys\JourneyTemplateReplaceRequest\Notification\Brand
 * @phpstan-import-type ContentShape from \Courier\Journeys\JourneyTemplateReplaceRequest\Notification\Content
 * @phpstan-import-type SubscriptionShape from \Courier\Journeys\JourneyTemplateReplaceRequest\Notification\Subscription
 *
 * @phpstan-type NotificationShape = array{
 *   brand: null|Brand|BrandShape,
 *   content: Content|ContentShape,
 *   name: string,
 *   subscription: null|Subscription|SubscriptionShape,
 *   tags: list<string>,
 * }
 */
final class Notification implements BaseModel
{
    /** @use SdkModel<NotificationShape> */
    use SdkModel;

    #[Required]
    public ?Brand $brand;

    #[Required]
    public Content $content;

    #[Required]
    public string $name;

    #[Required]
    public ?Subscription $subscription;

    /** @var list<string> $tags */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * `new Notification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Notification::with(
     *   brand: ..., content: ..., name: ..., subscription: ..., tags: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Notification)
     *   ->withBrand(...)
     *   ->withContent(...)
     *   ->withName(...)
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
     */
    public static function with(
        Brand|array|null $brand,
        Content|array $content,
        string $name,
        Subscription|array|null $subscription,
        array $tags,
    ): self {
        $self = new self;

        $self['brand'] = $brand;
        $self['content'] = $content;
        $self['name'] = $name;
        $self['subscription'] = $subscription;
        $self['tags'] = $tags;

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

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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
}
