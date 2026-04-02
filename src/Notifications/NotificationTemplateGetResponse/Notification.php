<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationTemplateGetResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent;
use Courier\Notifications\NotificationTemplatePayload\Brand;
use Courier\Notifications\NotificationTemplatePayload\Routing;
use Courier\Notifications\NotificationTemplatePayload\Subscription;

/**
 * Full document shape used in POST and PUT request bodies, and returned inside the GET response envelope.
 *
 * @phpstan-import-type BrandShape from \Courier\Notifications\NotificationTemplatePayload\Brand
 * @phpstan-import-type ElementalContentShape from \Courier\ElementalContent
 * @phpstan-import-type RoutingShape from \Courier\Notifications\NotificationTemplatePayload\Routing
 * @phpstan-import-type SubscriptionShape from \Courier\Notifications\NotificationTemplatePayload\Subscription
 *
 * @phpstan-type NotificationShape = array{
 *   brand: null|Brand|BrandShape,
 *   content: ElementalContent|ElementalContentShape,
 *   name: string,
 *   routing: null|Routing|RoutingShape,
 *   subscription: null|Subscription|SubscriptionShape,
 *   tags: list<string>,
 *   id: string,
 * }
 */
final class Notification implements BaseModel
{
    /** @use SdkModel<NotificationShape> */
    use SdkModel;

    /**
     * Brand reference, or null for no brand.
     */
    #[Required]
    public ?Brand $brand;

    #[Required]
    public ElementalContent $content;

    /**
     * Display name for the template.
     */
    #[Required]
    public string $name;

    /**
     * Routing strategy reference, or null for none.
     */
    #[Required]
    public ?Routing $routing;

    /**
     * Subscription topic reference, or null for none.
     */
    #[Required]
    public ?Subscription $subscription;

    /**
     * Tags for categorization. Send empty array for none.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * The template ID.
     */
    #[Required]
    public string $id;

    /**
     * `new Notification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Notification::with(
     *   brand: ...,
     *   content: ...,
     *   name: ...,
     *   routing: ...,
     *   subscription: ...,
     *   tags: ...,
     *   id: ...,
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
     *   ->withRouting(...)
     *   ->withSubscription(...)
     *   ->withTags(...)
     *   ->withID(...)
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
     * @param ElementalContent|ElementalContentShape $content
     * @param Routing|RoutingShape|null $routing
     * @param Subscription|SubscriptionShape|null $subscription
     * @param list<string> $tags
     */
    public static function with(
        Brand|array|null $brand,
        ElementalContent|array $content,
        string $name,
        Routing|array|null $routing,
        Subscription|array|null $subscription,
        array $tags,
        string $id,
    ): self {
        $self = new self;

        $self['brand'] = $brand;
        $self['content'] = $content;
        $self['name'] = $name;
        $self['routing'] = $routing;
        $self['subscription'] = $subscription;
        $self['tags'] = $tags;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Brand reference, or null for no brand.
     *
     * @param Brand|BrandShape|null $brand
     */
    public function withBrand(Brand|array|null $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

        return $self;
    }

    /**
     * @param ElementalContent|ElementalContentShape $content
     */
    public function withContent(ElementalContent|array $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Display name for the template.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Routing strategy reference, or null for none.
     *
     * @param Routing|RoutingShape|null $routing
     */
    public function withRouting(Routing|array|null $routing): self
    {
        $self = clone $this;
        $self['routing'] = $routing;

        return $self;
    }

    /**
     * Subscription topic reference, or null for none.
     *
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
     * Tags for categorization. Send empty array for none.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * The template ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
